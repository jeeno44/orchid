<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Task;
use Mockery\Exception;

class SendTelegrammCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'send:tg';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Отправляет сообщение в телеграм';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {

        try{
            $task = Task::where('status','active')->OrderBy('datetime')->first();
            $dt = $task->datetime;
        }
        catch(\Throwable $e){
            return $this->info($e->getMessage());
        }

        $date = new \Carbon\Carbon($dt);

//        dump($dt);
//        dump(now()->diffInMinutes($dt,false));
//        dump(now()->toDateTimeString());
        if (now()->diffInMinutes($dt,false) < 0){

            $url = "https://api.telegram.org/bot5594975307:AAFNLNLO06Gdvpp-3P4NbdmN1BYil5aLnDA/sendMessage?text=".$task->task."&chat_id=381581718";

            if ($_SERVER['APP_URL'] == "http://localhost"){
//                dump($_SERVER['SERVER_NAME']);
                $this->info("no send");
            }
            else{
                file_get_contents($url);
            }

            Task::where("id",$task->id)->update([
                "status" => "done"
            ]);

            return $this->info("SEND MESSAGE");
        }
        else{
            return $this->info("ПОКА РАНО");
        }
    }
}
