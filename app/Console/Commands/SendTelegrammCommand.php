<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

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
        return $this->info("send to telega");
    }
}
