<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redis;

class SendBackupDatabaseMoviesCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'database:back';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Делаем Бэкап Базы данных (таблица фильмов)';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        //Redis::set("name","SWIFT");

        //dump(Redis::get("name"));

        $films = DB::table("films")->orderBy("id")->get(["id","name","year"]);

        dump($films);

        return 0;
    }
}
