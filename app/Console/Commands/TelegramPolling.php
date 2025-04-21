<?php

namespace App\Console\Commands;

use App\Http\Controllers\TelegramController;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;

class TelegramPolling extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'bot:start';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Telegram polling started';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $this->info($this->description);
        $offset=0;
        while (true){
            $updates=$this->getUpdates($offset);
            if (count($updates) > 0){
                foreach ($updates as $update) {
                    $offset=$update['update_id']+1;
                    (new TelegramController())->handle(request()->merge($update));

                }
            }
        }

    }
    public function getUpdates($offset):array{
        $url="https://api.telegram.org/bot".config('services.telegram.api_key')."/getUpdates?offset={$offset}";
        $response=Http::get($url);
        return $response->json()['result'];
    }
}
