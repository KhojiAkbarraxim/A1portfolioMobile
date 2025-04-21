<?php

namespace App\Http\Controllers;

use App\Models\Criteria;
use App\Models\Commission;
use App\Models\Applications;
use App\Models\Announcement;
use App\Models\Applicationn;
use App\Models\TelegramUser;
use Illuminate\Http\Request;
use App\Models\CommissionScore;
use App\Services\TelegramService;
use Illuminate\Support\Facades\Log;

class TelegramController extends Controller
{
    public function handle(Request $request)
    {
        //TODO tanlovlar royhatini korsatganda faqat muddati o'tmaganlarini chiqarish
        $bot = new TelegramService();

        try {

            $input = $request->all();
            $chat_id=$this->getChatID($input);
            $user = TelegramUser::where('chat_id', $chat_id)->first();
//            echo "====================================================================================================\n";
//            print_r($input);
            if(!$user){
                $user=new TelegramUser();
                $user->chat_id=$chat_id;
                $user->step=null;
                $user->message_id=null;
                $user->save();
            }else{
                if (isset($input['message']['text'])){
                    if ($input['message']['text']=="/start"){
                        if (isset($input['callback_query']['message']['message_id'])){
                            if ($input['callback_query']['message']['message_id']<$input['message']['message_id']){
                               goto start_page;
                            }
                        }
                        $user->step=null;
                        $user->message_id=null;
                        $user->save();
                    }
                }elseif (isset($input['message']['contact'])){
                    if (isset($input['callback_query']['message']['message_id'])){
                        if ($input['callback_query']['message']['message_id']<$input['message']['message_id']){
                            goto contact_page;
                        }
                    }
                }
                $step=$user->step;

                if (str_contains($step,"ball_qoyish")){
                    $text=$input['message']['text'];
                    $a=explode("|",$user->step);
                    $criteria_id=$a[1];
                    $tanlov_id=$a[2];
                    $ishtirokchi_id=$a[3];

                    $criteria=Criteria::find($criteria_id);

                    if(!is_numeric($text) ){
                        $bot->sendMessage($chat_id,"Baholash uchun faqat sonlardan foydalaning");

                    }elseif (((int)$text)>$criteria->ball || ((int)$text)<0){
                        $bot->sendMessage($chat_id,"Maksimal ball: ".$criteria->ball." \n Minimal ball: 0"." \n Baholash uchun faqat oraliqdagi sonlardan foydalaning");
                    }else{
                        $ball=CommissionScore::all()
                            ->where("criteria_id",$criteria_id)
                            ->where("announcement_id",$tanlov_id)
                            ->where("application_id",$ishtirokchi_id)
                            ->where("commission_id",Commission::all()
                                ->where("phone",$user->phone)
                                ->where("announcement_id",$tanlov_id)
                                ->first()->id)
                            ->first();
                        if (!$ball) {
                            $ball = new CommissionScore();
                            $ball->criteria_id = $criteria_id;
                            $ball->announcement_id = $tanlov_id;
                            $ball->application_id = $ishtirokchi_id;
                            $ball->commission_id = Commission::all()
                                ->where("phone", $user->phone)
                                ->where("announcement_id", $tanlov_id)
                                ->first()->id;
                        }
                        $ball->score=$text;
                        $ball->save();
                        $keyboard = [
                            'inline_keyboard' => [
                            ],
                            'resize_keyboard' => true,
                        ];
                        $keyboard['inline_keyboard'][] = [
                            ['text' => "✅ Tasdiqlash", 'callback_data' => "bahoni_tasdiqlash|".$criteria_id."|".$tanlov_id."|".$ishtirokchi_id."|".$text]
                        ];


                        $reply_markup = json_encode($keyboard);

                        $bot->sendMessage($chat_id,$criteria->name." mezoni bo'yicha qo'yilgan bahoni tasdiqlang: ".$text." ball",$reply_markup);
                        $user->step="bahoni_tasdiqlash|".$criteria_id."|".$tanlov_id."|".$ishtirokchi_id."|".$text;
                        $user->save();
                    }
                }else{
                    if (isset($input['callback_query'])) {

                        $callbackData = $input['callback_query']['data'];
                        $chat_id = $input['callback_query']['message']['chat']['id'];
                        $callbackId = $input['callback_query']['id'];
                        try {
                            $bot->respondToCallback($callbackId);
                        } catch (\Exception $exception) {
                            Log::error($exception->getMessage());
                        }
//                $bot->sendMessage($chat_id, "callback query: " . json_encode($input, JSON_PRETTY_PRINT));
                        if (str_contains($callbackData,"selected_tanlov")){
                            list($key, $action) = explode('|', $callbackData);

                            $tanlov=Announcement::all()->find($key);

                            $matn_ishtirokchilar="Tanlov nomi: ".$tanlov->name." \n Baholash uchun quyidagi ishtorikchilardan birini tanlang:\n";
                            $ishtirokchilar=Applicationn::all()->where("announcement_id",$tanlov->id);
                            $inline_keyboard = [
                                'inline_keyboard' => [
                                ],
                                'resize_keyboard' => true,
                            ];
                            $inline_keyboard['inline_keyboard'][] = [
                                ['text' => "🔙 Orqaga", 'callback_data' => "back_tanlovlar_royhati"]
                            ];
                            foreach ($ishtirokchilar as $ishtirokchi) {
                                $inline_keyboard['inline_keyboard'][] = [
                                    ['text' => $ishtirokchi->fio, 'callback_data' => $ishtirokchi->id . "|selected_ishtorokchi|".$tanlov->id]
                                ];
                            }
                            $reply_markup = json_encode($inline_keyboard);
                            if ($matn_ishtirokchilar!=$input['callback_query']['message']['text']){
                                $bot->editMessage(
                                    $chat_id,
                                    $matn_ishtirokchilar,
                                    $input['callback_query']['message']['message_id'],
                                    $reply_markup
                                );

                            }



                        }
                        elseif (str_contains($callbackData,"selected_ishtorokchi")){

                            $user->message_id=$input['callback_query']['message']['message_id'];
                            $user->save();
                            $old_message_text=$input['callback_query']['message']['text'];
                            $this->showSelectedIshtorikchi($bot,$chat_id,$user,$callbackData,$old_message_text);
                        }
                        elseif (str_contains($callbackData,"back_tanlovlar_royhati")) {

                            $user = TelegramUser::where("chat_id", $chat_id)->first();
                            $commission_memeber = Commission::all()->where('phone', $user->phone)->sortByDesc('announcement_id');
                            if ($commission_memeber->count() > 0) {
                                $tanlovlar = [];
                                foreach ($commission_memeber as $item) {
                                    $aa=["id"=>$item->tanlov->id,"name"=>$item->tanlov->name,"selection_begin"=>$item->tanlov->selection_begin,"selection_date"=>$item->tanlov->selection_date];
                                    $tanlovlar[$item->tanlov->id] = (object)$aa;
                                }
                                $inline_keyboard = [
                                    'inline_keyboard' => [
                                    ],
                                    'resize_keyboard' => true,
                                ];
                                foreach ($tanlovlar as $key => $tanlov) {
                                    if (date("Y-m-d",strtotime($tanlov->selection_begin))<=date("Y-m-d") and date("Y-m-d",strtotime($tanlov->selection_date))>=date("Y-m-d")){

                                        $inline_keyboard['inline_keyboard'][] = [
                                            ['text' => $tanlov->name, 'callback_data' => $key . "|selected_tanlov"]
                                        ];
                                    }
                                }
                                $reply_markup = json_encode($inline_keyboard);
                                $txt="Siz quyidagi tanlovlarda komissiya a'zosi sifatida ishtirok etmoqdasiz: \n";
                                if ($txt!=$input['callback_query']['message']['text']){
                                    $bot->editMessage(
                                        $chat_id,
                                        $txt,
                                        $input['callback_query']['message']['message_id'],
                                        $reply_markup
                                    );
                                }

                            }
                        }
                        elseif (str_contains($callbackData,"back_ishtirokchi_royhati")){
                            $tanlov_id=(explode("|",$callbackData))[1];

                            $tanlov=Announcement::all()->find($tanlov_id);

                            $matn_ishtirokchilar="Tanlov nomi: ".$tanlov->name." \n Baholash uchun quyidagi ishtorikchilardan birini tanlang:\n";
                            $ishtirokchilar=Applicationn::all()->where("announcement_id",$tanlov->id);
                            $inline_keyboard = [
                                'inline_keyboard' => [
                                ],
                                'resize_keyboard' => true,
                            ];
                            $inline_keyboard['inline_keyboard'][] = [
                                ['text' => "🔙 Orqaga", 'callback_data' => "back_tanlovlar_royhati"]
                            ];
                            foreach ($ishtirokchilar as $ishtirokchi) {
                                $inline_keyboard['inline_keyboard'][] = [
                                    ['text' => $ishtirokchi->fio, 'callback_data' => $ishtirokchi->id . "|selected_ishtorokchi|".$tanlov->id]
                                ];
                            }
                            $reply_markup = json_encode($inline_keyboard);
                            if ($matn_ishtirokchilar!=$input['callback_query']['message']['text']) {
                                $bot->editMessage(
                                    $chat_id,
                                    $matn_ishtirokchilar,
                                    $input['callback_query']['message']['message_id'],
                                    $reply_markup
                                );
                            }

                        }
                        elseif (str_contains($callbackData,"selected_mezon")){
                            $data=explode("|",$callbackData);
                            $criteria_id=$data[0];
                            $tanlov_id=$data[2];
                            $ishtirokchi_id=$data[3];
                            $ball=CommissionScore::all()
                                ->where("criteria_id",$criteria_id)
                                ->where("announcement_id",$tanlov_id)
                                ->where("commission_id",Commission::all()
                                    ->where("phone",$user->phone)
                                    ->where("announcement_id",$tanlov_id)
                                    ->first()->id)
                                ->where("application_id",$ishtirokchi_id)
                                ->first();
                            if ($ball){
                                $ball=$ball->score;
                            }else{
                                $ball=0;
                            }

                            $criteria=Criteria::find($criteria_id);
                            $mezon_matn=$criteria->name." mezoni bo'yicha qo'yilgan  bahoni yozib yuboring, maksimal ball:".$criteria->ball." \n"."Hozirgi holati:".$ball."/". $criteria->ball;
                            $bot->sendMessage(
                                $chat_id,
                                $mezon_matn
                            );
                            $user = TelegramUser::where("chat_id", $chat_id)->first();
                            $user->step="ball_qoyish|".$criteria_id."|".$tanlov_id."|".$ishtirokchi_id;
                            $user->save();


                        }
                        elseif (str_contains($callbackData,"bahoni_tasdiqlash")){
                            $data=explode("|",$callbackData);
                            $criteria_id=$data[1];
                            $tanlov_id=$data[2];
                            $ishtirokchi_id=$data[3];
                            $ball=$data[4];
                            $ball=CommissionScore::all()
                                ->where("criteria_id",$criteria_id)
                                ->where("announcement_id",$tanlov_id)
                                ->where("application_id",$ishtirokchi_id)
                                ->where("commission_id",Commission::all()
                                    ->where("phone",$user->phone)
                                    ->where("announcement_id",$tanlov_id)
                                    ->first()->id)
                                ->first();
                            $ball->score=$data[4];
                            $ball->save();
                            $bot->editMessageReplyMarkup(
                                $chat_id,
                                $input['callback_query']['message']['message_id']
                            );
                            $bot->sendMessage(
                                $chat_id,
                                "Baholash muvaffaqiyatli yakunlandi ✅ "
                            );
                            $this->showSelectedIshtorikchi($bot,$chat_id,$user,$ishtirokchi_id."|selected_ishtorokchi|".$tanlov_id,$input['callback_query']['message']['text']);
                            $user = TelegramUser::where("chat_id", $chat_id)->first();
                            $user->step=null;
                            $user->save();
                        }



                    }
                    elseif (isset($input['message']['contact']))
                    {
                        contact_page:
                        $contact = $input['message']['contact'];
                        $chat_id = $contact['user_id'];


                        $user = TelegramUser::where('chat_id', $chat_id)->first();
                        if ($user) {
                            $user->phone = $contact['phone_number'];
                            $user->save();
                        }
                        $commission_memeber = Commission::all()
                            ->where('phone', $user->phone)
                            ->sortByDesc('announcement_id');
                        if ($commission_memeber->count() > 0) {
                            $tanlovlar = [];
                            foreach ($commission_memeber as $item) {
                                $aa=["id"=>$item->tanlov->id,"name"=>$item->tanlov->name,"selection_begin"=>$item->tanlov->selection_begin,"selection_date"=>$item->tanlov->selection_date];
                                $tanlovlar[$item->tanlov->id] = (object)$aa;
                            }
                            $inline_keyboard = [
                                'inline_keyboard' => [
                                ],
                                'resize_keyboard' => true,
                            ];
                            $tx=false;
                            foreach ($tanlovlar as $key => $tanlov) {
                                if (date("Y-m-d",strtotime($tanlov->selection_begin))<=date("Y-m-d") and date("Y-m-d",strtotime($tanlov->selection_date))>=date("Y-m-d")){
                                    $tx=true;
                                    $inline_keyboard['inline_keyboard'][] = [
                                        ['text' => $tanlov->name, 'callback_data' => $key . "|selected_tanlov"]
                                    ];
                                }
                            }
                            $reply_markup = json_encode($inline_keyboard);
                            if ($tx){
                                $bot->sendMessage(
                                    $chat_id,
                                    "Siz quyidagi tanlovlarda komissiya a'zosi sifatida ishtirok etmoqdasiz: \n",
                                    $reply_markup
                                );
                            }else{
                                $bot->sendMessage(
                                    $chat_id,
                                    "Siz komissiya a'zosisiz. Hozirda aktiv  tanlovlar yo'q \n",
                                    $reply_markup
                                );
                            }



                        } else {
                            $bot->sendMessage(
                                $chat_id,
                                "Siz komissiya a'zosi emassiz"
                            );
                        }

                    }
                    elseif (isset($input['message'])) {
                        $message = $input['message'];
                        $chat_id = $message['chat']['id'];
                        $user = TelegramUser::where('chat_id', $chat_id)->first();
                        if (!$user) {
                            $user = new TelegramUser();
                            $user->chat_id = $chat_id;

                        }else{
                            $user->step=null;
                        }
                        $user->save();


                        if (isset($message['text'])) {
                            $text = $message['text'];
                            if ($text == "/start") {
                                start_page:
                                $keyboard = [
                                    'keyboard' => [
                                        [
                                            ['text' => " 📞 Telefon raqamni yuborish", 'request_contact' => true]
                                        ]
                                    ],
                                    'resize_keyboard' => true,
                                    'one_time_keyboard' => true
                                ];


                                $reply_markup = json_encode($keyboard);
                                $msg = "Assalomu alaykum, botdan foydalanish uchun telefon raqamingizni yuboring.";
                                $bot->sendMessage($chat_id, $msg, $reply_markup);
                            }
                            elseif (str_contains($user->step,"ball_qoyish")){

                                }
                            elseif (($input['message']['text']=="/tanlovlar")){
                                if ($user->phone==null){
                                    $keyboard = [
                                        'keyboard' => [
                                            [
                                                ['text' => " 📞 Telefon raqamni yuborish", 'request_contact' => true]
                                            ]
                                        ],
                                        'resize_keyboard' => true,
                                        'one_time_keyboard' => true
                                    ];
                                    $reply_markup = json_encode($keyboard);
                                    $msg = "Botdan foydalanish uchun telefon raqamingizni yuboring.";
                                    $bot->sendMessage($chat_id, $msg, $reply_markup);
                                }else {
                                    $commission_memeber = Commission::all()->where('phone', $user->phone)->sortByDesc('announcement_id');
                                    if ($commission_memeber->count() > 0) {
                                        $tanlovlar = [];
                                        foreach ($commission_memeber as $item) {
                                            $aa = ["id" => $item->tanlov->id, "name" => $item->tanlov->name, "selection_begin" => $item->tanlov->selection_begin, "selection_date" => $item->tanlov->selection_date];
                                            $tanlovlar[$item->tanlov->id] = (object)$aa;
                                        }
                                        $inline_keyboard = [
                                            'inline_keyboard' => [
                                            ],
                                            'resize_keyboard' => true,
                                        ];
                                        $log = false;
                                        foreach ($tanlovlar as $key => $tanlov) {
                                            if (date("Y-m-d", strtotime($tanlov->selection_begin)) <= date("Y-m-d") and date("Y-m-d", strtotime($tanlov->selection_date)) >= date("Y-m-d")) {
                                                $log = true;
                                                $inline_keyboard['inline_keyboard'][] = [
                                                    ['text' => $tanlov->name, 'callback_data' => $key . "|selected_tanlov"]
                                                ];
                                            }
                                        }
                                        $reply_markup = json_encode($inline_keyboard);
                                        if ($log) {
                                            $bot->sendMessage($chat_id, "Siz quyidagi tanlovlarda komissiya a'zosi sifatida ishtirok etmoqdasiz: \n", $reply_markup);
                                        } else {
                                            $bot->sendMessage($chat_id, "Siz komissiya a'zosisiz. Hozirda aktiv  tanlovlar yo'q \n", $reply_markup);
                                        }
                                    } else {
                                        $bot->sendMessage($chat_id, "Siz komissiya a'zosi emassiz");
                                    }
                                }
                            }
                            }
                        }





                }
            }






//        $bot->sendMessage($chat_id,"all in one \n".json_encode($input,JSON_PRETTY_PRINT));

        }
        catch (\Exception $exception){
            $bot = new TelegramService();
            $bot->sendMessage(1490424185,"xatolik:".$exception->getMessage()." ".$exception->getLine()." ".$exception->getFile()." ".$exception->getCode());
            Log::error($exception->getMessage());
        }
    }

    private function getChatID($input)
    {
        if (isset($input['callback_query'])) {
            return $input['callback_query']['message']['chat']['id'];
        } elseif (isset($input['message'])) {
            return $input['message']['chat']['id'];
        } elseif (isset($input['edited_message'])) {
            return $input['edited_message']['chat']['id'];
        }
    }

    private function showSelectedIshtorikchi($bot,$chat_id,$user,$callbackData,$old_message_text=null){

        list($key, $action) = explode('|', $callbackData);
        $tanlov_id=(explode("|",$callbackData))[2];

        $ishtorikchi=Applicationn::find($key);
        $tanlov=Announcement::find($tanlov_id);
        $criteria=Criteria::where("announcement_id",$tanlov_id)->get();
        $matn_criteria="Tanlov: ".$tanlov->name." \n";
        $matn_criteria.="Talaba: ".$ishtorikchi->fio." \n";
        $matn_criteria.="Baholar:\n";
        $commission=Commission::all()
            ->where("phone",$user->phone)
            ->where("announcement_id",$tanlov_id)
            ->first();

        $inline_keyboard = [
            'inline_keyboard' => [
            ],
            'resize_keyboard' => true,
        ];
        $inline_keyboard['inline_keyboard'][] = [
            ['text' => "🔙 Orqaga", 'callback_data' => "back_ishtirokchi_royhati|".$tanlov_id]
        ];
        foreach ($criteria as $criterion) {
            $current_ball=CommissionScore::all()
                ->where("commission_id",$commission->id)
                ->where("application_id",$ishtorikchi->id)
                ->where("criteria_id",$criterion->id)
                ->where("announcement_id",$tanlov->id)
                ->first();
            if ($current_ball){
                $current_ball=$current_ball->score;

            }else{
                $current_ball=0;
                $inline_keyboard['inline_keyboard'][] = [
                    ['text' => $criterion->name."(".$criterion->ball.")", 'callback_data' => $criterion->id . "|selected_mezon|".$tanlov->id."|".$ishtorikchi->id]
                ];
            }
            $matn_criteria.=$criterion->name."- ".$current_ball."/".$criterion->ball." ball \n";

        }
        $matn_criteria.="Baholash uchun ushbu mezonlardan birini tanlang \n";

        $reply_markup = json_encode($inline_keyboard);

        if ($old_message_text!=$matn_criteria){
            if ($user->message_id!=null) {

                $az=$bot->editMessage(
                    $chat_id,
                    $matn_criteria,
                    $user->message_id,
                    $reply_markup
                );
                $user->message_id=$az['result']['message_id'];
                $user->save();
            }
        }


    }
}