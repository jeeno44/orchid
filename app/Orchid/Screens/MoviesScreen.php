<?php

namespace App\Orchid\Screens;

use App\Models\Film;
use Illuminate\Http\Request;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Fields\Code;
use Orchid\Support\Facades\Alert;
use Orchid\Support\Facades\Toast;
use Request as Rq;
use Illuminate\Pagination\Paginator;
use Orchid\Screen\Actions\ModalToggle;
use Orchid\Screen\Fields\DateTimer;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Select;
use Orchid\Screen\Screen;
use Orchid\Screen\TD;
use Orchid\Support\Facades\Layout;

class MoviesScreen extends Screen
{
    /**
     * Query data.
     *
     * @return array
     */
    public function query(): iterable
    {
        try {
            $fullUrl = Rq::getRequestUri();
            $fullUrl = explode("?",$fullUrl);
            $currentPage = str_replace("page=","",$fullUrl[1]);
        }
        catch (\Exception $exception){
            $currentPage = 1;
        }

        Paginator::currentPageResolver(function () use ($currentPage) {
            return $currentPage;
        });

        return [
            "films" => Film::orderBy("id")->paginate(30)
        ];
    }

    /**
     * Display header name.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return 'Фильмы и сериалы';
    }

    /**
     * Button commands.
     *
     * @return \Orchid\Screen\Action[]
     */
    public function commandBar(): iterable
    {
        return [
            ModalToggle::make("Редактировать фильм или сериал")->modal("editMovie")->method("editmovie"),
            ModalToggle::make("Добавить фильм или сериал")->modal("appendMovie")->method("setmovie"),
            ModalToggle::make("УдОлить")->modal("deleteMovie")->method("delmovie"),
        ];
    }

    /**
     * Views.
     *
     * @return \Orchid\Screen\Layout[]|string[]
     */
    public function layout(): iterable
    {
        return [
            Layout::table("films",[
                TD::make("id")->width(90),
                TD::make("name","Имя"),
                TD::make("year","Год"),
                TD::make("type","Тип")->render(function (Film $film){
                    //return $film->type === "movie" ? "Фильм" : "Сериал";
                    switch ($film->type){
                        case "movie": return "Фильм" ; break;
                        case "tv_show": return "Сериал" ; break;
                        case "cartoon": return "Мультфильм" ; break;
                        case "short_movie": return "Короткометражка" ; break;
                    }
                }),
                TD::make("watched","Просмотрено")->render(function (Film $film){
                    return $film->watched === 0 ? "Не просмотрено" : "Просмотрено";
                }),
                TD::make('Edit')->render(function(Film $film){
                    return ModalToggle::make("Редакторовать")
                        ->modal("editMovie")
                        ->method("editmovie")
                        ->modalTitle("Редактировать задание ".$film->name)
                        ->asyncParameters([
                            'film' => $film->id
                        ]);
                }),
                TD::make("Dels")->width(70)->align(TD::ALIGN_RIGHT)->render(function (Film $film){
                    return ModalToggle::make("Удалить - ".$film->id)
                        ->modal("deleteMovie")
                        ->method("delmovie")
                        ->modalTitle("Удалить")
                        ->asyncParameters([
                            "film" => $film->id
                        ]);
                }),
                /*TD::make("dels","Del")->width(70)->align(TD::ALIGN_RIGHT)->render(function (Film $film){
                    return Link::make("del - ".$film->id)
                        ->href("delfilm/".$film->id);
                })*/
            ]),
            Layout::modal("appendMovie",Layout::rows([
                Input::make('name')->required()->type("text")->title('Имя'),
                Input::make('year')->required()->type("text")->title('Год'),
                Select::make("type")->options([
                    'movie' => 'Фильм',
                    'tv_show' => 'Сериал',
                    'cartoon' => 'Мультфильм',
                    'short_movie' => 'Короткометражка',
                ]),
                Select::make("watched")->options([
                    '0' => 'Не посмотрено',
                    '1' => 'Посмотрено',
                ]),
            ]))->title("Добавление фильма или сериала")->applyButton("Добавить")->closeButton("Отмена"),
            Layout::modal("editMovie",Layout::rows([
                Input::make("film.id")->type("hidden"),
                Input::make("film.name"),
                Input::make("film.year"),
                Select::make("film.type")->options([
                    'movie' => 'Фильм',
                    'tv_show' => 'Сериал',
                    'cartoon' => 'Мультфильм',
                    'short_movie' => 'Короткометражка',
                ]),
                Select::make("film.watched")->options([
                    '0' => 'Не посмотрено',
                    '1' => 'Посмотрено',
                ]),
            ]))->async("asyncGetFilm"),
                //->title("Редактирование фильма или сериала")->applyButton("Редактировать")->closeButton("Отмена"),
            Layout::modal("deleteMovie",Layout::rows([
//                Link::make("Удалить")->href("delfilm/film.id")
                //Input::make("DELETE")->type("text")->title("Действительн удалить ?"),
                Button::make("con")->confirm("Вы уверены ?"),
                Input::make("film.id")->type('hidden'),
            ]))->title("Удалить фильм")->applyButton("Удалить")->async("asyncGetFilm"),
        ];
    }

    public function setmovie (Request $request)
    {
        $rules=[
            'name' => ['required','min:4'],
            'year' => ['required','min:4','max:4']
        ];

        $this->validate($request,$rules);

        Film::create($request->all());

        //return view("setmovie",compact(""));
    }

    public function editmovie (Request $request)
    {
        Film::where("id",$request->film["id"])->update([
            "id" => $request->film["id"],
            "name" => $request->film["name"],
            "year" => $request->film["year"],
            "type" => $request->film["type"],
            "watched" => $request->film["watched"],
        ]);
    }

    public function delmovie (Request $request)
    {
//        echo "GOOD YEAR";
        Toast::info('DELETE THIS MOVIE - '.$request->film['id']);
        //Alert::message("DELETE FILM");
    }

    public function asyncGetFilm (Film $film):array
    {
        return [
            "film" => $film,
        ];
    }

    /*public function asyncGetFilm (Film $film):array
    {
        return [
            "film" => $film,
        ];
    }*/
}
