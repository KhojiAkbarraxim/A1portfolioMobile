<?php

namespace App\Http\Controllers\ITB;

use App\Models\Criteria;
use App\Models\Commission;
use Illuminate\Http\Request;
use App\Models\Announcement;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use  Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;


class AnnouncementController extends Controller
{
    public function index()
    {
        $announcements = DB::table('announcement')
            ->leftJoin("applications", "announcement.id", "applications.announcement_id")
            ->selectRaw("announcement.*, count(applications.announcement_id) as applicationCount")
            ->groupBy("announcement.id")
            ->get();
        // select('name', 'app_begin', 'app_deadline', 'selection_begin', 'selection_date');
        return view('itb.announcement.index', compact('announcements'));
    }
    public function ApiIndex()
    {
        $announcements = Announcement::all();
        return response()->json($announcements);
    }
    public function create()
    {
        return view('itb.announcement.create');
    }
    public function store(Request $request)
    {
        // dd($request->description);
        $request->validate(
            [
                'name' => 'required|min:5',
                // 'ariza_begin' => 'required|date',
                'ariza_end' => 'required|date|after:ariza_begin',
                'tanlov_begin' => 'required|date|after:ariza_end',
                'tanlov_end' => 'required|after:tanlov_begin',
                'description' => 'required|min:10',
                'image' => 'required|file|mimes:jpg,png,jpeg'
            ],
            [
                'name.required' => 'Tanlov nomi kiritilishi majburiy!',
                'name.min' => 'Tanlov nomi 5ta harfdan kam bo\'lmasligi kerak!',
                'ariza_begin.required' => 'Ariza qabul qilishning boshlanish sanasi kiritilishi majburiy!',
                'ariza_end.required' => 'Ariza qabul qilishning tugash sanasi kiritilishi majburiy!',
                'ariza_end.after' => 'Ariza qabul qilishning tugash sanasi, boshlanish sanasidan keyin keladigan kun bo\'lishi kerak',
                'tanlov_begin.required' => 'Tanlov o\'tkaziladigan sana kiritilishi majburiy!',
                'tanlov_begin.after' => 'Tanlov o\'tkaziladigan sana ariza qabuli tugash sanasidan keyingi kun bo\'lishi!',
                'tanlov_end.required' => 'Tanlov tugaydigan sana kiritilishi majburiy!',
                'tanlov_end.after' => 'Tanlov tugash sanasi, tanlov boshlanish sanasidan keyin keladigan kun bo\'lishi kerak',
                'description.required' => "Umumiiy ma'lumot kiritlishi majburiy!",
                'description.min' => "Umumiiy ma'lumot 10ta harfdan kam bo'lmasligi kerak!",
                'image.required' => "Tanlov rasmini yuklashinggiz kerak!",
                'image.mimes' => "Tanlov rasmi jpg, png yoki jpeg formatida bo'lishi kerak!"

            ]
        );
//        $img_name = $request->file('image')->store('tanlov', ['disk' => 'public']);
//        $full_path = storage_path('app/public/' . $img_name);
//        $full_thumb_path = storage_path('app/public/thumb/' . $img_name);
//        $thumb = Image::make($full_path);
//        $thumb->fit(300, 300, function ($constraint) {
//            $constraint->aspectRatio();
//        })->save($full_thumb_path);
        Announcement::create([
            'name' => $request->post('name'),
            'image' => "dfdsf",
            'thumb_image' => 'thumb/' . "dgdhfg",
            'app_begin' => $request->post('ariza_begin'),
            'app_deadline' => $request->post('ariza_end'),
            'selection_begin' => $request->post('tanlov_begin'),
            'selection_date' => $request->post('tanlov_end'),
            'description' => $request->post('description')
        ]);
        return redirect()->route('announcement.index')->with('success', "Tanlov muvaffaqiyatli qo'shildi!")->response()->json(200);
    }
    public function show($id)
    {
        $tanlov = Announcement::findOrFail($id);
        $applications = DB::table("applications")->where("announcement_id", "=" ,$id)->get();
        $commissions = Commission::where('announcement_id', '=', $tanlov->id)->get();
        $criteries = Criteria::where('announcement_id', '=', $tanlov->id)->get();
        return view('itb.announcement.show', compact('tanlov', 'commissions', 'criteries', 'applications'));
    }
    public function edit($id)
    {
        $tanlov = Announcement::findOrFail($id);
        // dd($tanlov);
        return view('itb.announcement.update', compact('tanlov'));
    }
    public function update(Request $request, $id)
    {
        $tanlov = Announcement::findOrFail($id);
        $request->validate(
            [
                'name' => 'required|min:5',
                // 'ariza_begin' => 'required|date',
                'ariza_end' => 'required|date|after:ariza_begin',
                'tanlov_begin' => 'required|date|after:ariza_end',
                'tanlov_end' => 'required|after:tanlov_begin',
                'description' => 'required|min:10'
            ],
            [
                'name.required' => 'Tanlov nomi kiritilishi majburiy!',
                'name.min' => 'Tanlov nomi 5ta harfdan kam bo\'lmasligi kerak!',
                'ariza_begin.required' => 'Ariza qabul qilishning boshlanish sanasi kiritilishi majburiy!',
                'ariza_end.required' => 'Ariza qabul qilishning tugash sanasi kiritilishi majburiy!',
                'ariza_end.after' => 'Ariza qabul qilishning tugash sanasi, boshlanish sanasidan keyin keladigan kun bo\'lishi kerak',
                'tanlov_begin.required' => 'Tanlov o\'tkaziladigan sana kiritilishi majburiy!',
                'tanlov_begin.after' => 'Tanlov o\'tkaziladigan sana ariza qabuli tugash sanasidan keyingi kun bo\'lishi!',
                'tanlov_end.required' => 'Tanlov tugaydigan sana kiritilishi majburiy!',
                'tanlov_end.after' => 'Tanlov tugash sanasi, tanlov boshlanish sanasidan keyin keladigan kun bo\'lishi kerak',
                'description.required' => "Umumiiy ma'lumot kiritlishi majburiy!",
                'description.min' => "Umumiiy ma'lumot 10ta harfdan kam bo'lmasligi kerak!"

            ]
        );
        if ($request->file('image')) {
            //Delete old file
            Storage::disk('public')->delete([
                $tanlov->image,
                $tanlov->thumb_image
            ]);
            // rasmni yuklash
            $img_name = $request->file('image')->store('tanlov', ['disk' => 'public']);

            $full_path = storage_path('app/public/' . $img_name);
            $full_thumb_path = storage_path('app/public/thumb/' . $img_name);
            $thumb = Image::make($full_path);
            //Kvadrat qilib qirqish
            $thumb->fit(300, 300, function ($constraint) {
                $constraint->aspectRatio();
            })->save($full_thumb_path);
        } else {
            $img_name = $tanlov->image;
            $thumb_name = $tanlov->thumb_image;
        }

        $tanlov->update([
            'name' => $request->post('name'),
            'app_begin' => $request->post('ariza_begin'),
            'app_deadline' => $request->post('ariza_end'),
            'selection_begin' => $request->post('tanlov_begin'),
            'selection_date' => $request->post('tanlov_end'),
            'description' => $request->post('description'),
            'image' => $img_name,
            'thumb_image' => 'thumb/' . $img_name,
        ]);

        return redirect()->route('announcement.index')->with('success', "Tanlov tahrirlandi!");
    }
    public function destroy($id)
    {
        $id = Announcement::findOrFail($id);
        // dd($id->image);
        //Delete old file
        Storage::disk('public')->delete([
            $id->image,
            $id->thumb_image
        ]);
        $id->delete();
        return redirect()->route('announcement.index')->with('delete', 'Tanlov o\'chirildi!');
    }
}
