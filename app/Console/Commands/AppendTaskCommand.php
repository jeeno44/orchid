<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Task;

class AppendTaskCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'set:task {task} {datetime}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Установить задачу для телеграма';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
	Task::create([
	"task" => $this->argument("task"),
	"datetime" => $this->argument("datetime"),
	]);
        return $this->info($this->argument('task').' - '.$this->argument('datetime'));
    }
}
