<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Illuminate\Support\Facades\Log;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {





        // $schedule->command('inspire')->hourly();
         $schedule->command('send:tg')->everyMinute();
         $schedule->command('database:back')->everyMinute();
         /*$schedule->call(function () {
             $TOKEN = "5594975307:AAFNLNLO06Gdvpp-3P4NbdmN1BYil5aLnDA";


             function SendTelega($token,$text,$chatId){
                 $url = "https://api.telegram.org/bot".$token."/sendMessage?text=".$text."&chat_id=".$chatId;
                 file_get_contents($url);
             }


             if ((now()->hour.":".now()->minute) == "8:20"){
                 $this->info("GOOD");
                 Log::info("GOOG");
                 SendTelega($TOKEN,"Поставить свечи","381581718");
             }
             else{
                 $this->info("BAD");
                 Log::info("BAD");
             }
         })->everyMinute();*/
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
