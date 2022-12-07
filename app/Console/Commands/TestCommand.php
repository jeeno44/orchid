<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use Illuminate\Console\Command;

class TestCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'test:self';

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
        $this->info(now()->hour.":".now()->minute);
        if ((now()->hour.":".now()->minute) == "21:10"){
            $this->info("GOOD");
        }
        else{
            $this->info("BAD");
        }

        return 0;
    }
}
