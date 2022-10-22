<?php

namespace App\Console\Commands;

use App\Models\Film;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;

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

		    if(Redis::get("films") != $films->count()){
			    //echo "ДЕЛАЕМ БЭКАП \n";
			    // ТУТ ЛОГИКА БЭКАПА НА ЕМЕЙЛ ЛИБО В ФАЙЛ
//                $filmsFromBD = Film::get(["id","name","year","type"]);
                $filmsFromBD = Film::orderBy("id")->get(["id","name","year","type"]);
                Storage::put("films.json",json_encode($filmsFromBD,JSON_UNESCAPED_UNICODE|JSON_PRETTY_PRINT));
                Storage::append("films.json",json_encode(["Всего фильмов" => $films->count()],JSON_UNESCAPED_UNICODE|JSON_PRETTY_PRINT));

//                $TOKEN = "5594975307:AAFNLNLO06Gdvpp-3P4NbdmN1BYil5aLnDA";


//                $chitID = "381581718"; // orchid_telega_bot
                $chitID = ""; // orchid_films_telega_bot
                //$token = "5594975307:AAFNLNLO06Gdvpp-3P4NbdmN1BYil5aLnDA";
                $token = "5632292733:AAHXN2dpq-gNgPcuJsteRtgynbF5LuCB7gY";
                //https://api.telegram.org/bot<5632292733:AAHXN2dpq-gNgPcuJsteRtgynbF5LuCB7gY>/getUpdates


                //$filename = Storage::get("films.json");

                // Create CURL object
//                $ch = curl_init();
//                curl_setopt($ch, CURLOPT_URL, "https://api.telegram.org/bot".$token."/sendDocument?chat_id=".$chitID);
//                curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
//                curl_setopt($ch, CURLOPT_POST, 1);

                // Create CURLFile
                //$finfo = finfo_file(finfo_open(FILEINFO_MIME_TYPE), $filename);
                //$cFile = new CURLFile($filename, $finfo);

                // Add CURLFile to CURL request
                /*curl_setopt($ch, CURLOPT_POSTFIELDS, [
                    "document" => $cFile
                ]);*/

                // Call
//                curl_exec($ch);
                //$result = curl_exec($ch);

                // Show result and close curl
//                var_dump($result);
//                curl_close($ch);

                //$url = "https://api.telegram.org/bot".$token."/&chat_id=381581718";
                //###$url = "https://api.telegram.org/bot".$token."/sendMessage?text=".json_encode($filmsFromBD,JSON_UNESCAPED_UNICODE)."&chat_id=381581718";
//                $url = "https://api.telegram.org/bot".$token."/sendMessage?text=БЕКАП_ФИЛЬМОВ_(".$films->count().")&chat_id=381581718";
                //file_get_contents($url);

			    //mail("jeep456@yandex.ru","Subject","Hello");

                //echo "После Бэкапа занисываем в РЕДИС новое значение всех фильмов в базе \n";
                Redis::set("films",$films->count());
            }
            else{
			    echo "Ничего не делаем \n";
		    }
	    }

        return 0;
    }
}
