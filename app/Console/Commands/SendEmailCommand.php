<?php

namespace App\Console\Commands;

use App\Mail\SendEmail;
use Illuminate\Console\Command;

class SendEmailCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 's:e';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {

        //$to = "jeep456@yandex.ru";
        //$sub = "From ORCHID";
        //$message = "Hello";
        //mail($to,$sub,$message);
        //new SendEmail();
        //return 0;
    }
}
