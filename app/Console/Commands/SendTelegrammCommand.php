<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Task;

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
$task = Task::where('id',3)->where('status','active')->first();
	}
	catch(\Exception $e){
	return $this->info($e);
	}
$dt = $task->datetime;
$date = new \Carbon\Carbon($dt);

dump($date->diffInMinutes(now()->toDateTimeString()));
dump(now()->toDateTimeString());
 

        return $this->info("send to telega");
    }
}
