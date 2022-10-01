<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Mail;

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

	    $red_value = Redis::get("films");

        $films = DB::table("films")->orderBy("id")->get(["id","name","year"]);

        //dump($films->count());

        if ($red_value == null){
            echo "НЕТ ЗНАЧЕНИЯ\n";
            echo "Установим значение из базы данных\n";

            Redis::set("films",$films->count());
	    }
	    else{
            echo "Значение из редиски - ".Redis::get("films")."\n";
		    echo "Значение из базы - ".$films->count()."\n";

		    if( Redis::get("films") != $films->count()){
			    echo "ДЕЛАЕМ БЭКАП \n";
			    // ТУТ ЛОГИКА БЭКАПА НА ЕМЕЙЛ ЛИБО В ФАЙЛ
                Mail::send(["THIS MESSAGE","Subject",function ($message){
                    $message->to("jeep456@yandex.ru","Hello From Jeen")->subject("JUST SUBJECT");
                    $message->from(env("MAIL_FROM_ADDRESS",""),"Jeeno Left Blog");
                });
                //
			    //mail("jeep456@yandex.ru","Subject","Hello");
			    echo "После Бэкапа занисываем в РЕДИС новое значение всех фильмов в базе \n";
            }
            else{
			    echo "Ничего не делаем \n";
		    }
	    }

        return 0;
    }
}
