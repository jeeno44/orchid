<?php

namespace App\Orchid\Screens;

use App\Models\Film;
use Illuminate\Support\Facades\Request;
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
        return [
            "films" => Film::orderBy("id")->paginate()
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
            //ModalToggle::make("Редактировать задание")->modal("editTask")->method("edittask"),
            ModalToggle::make("Добавить фильм или сериал")->modal("appendMovie")->method("setmovie"),
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
                TD::make("id")->width(50),
                TD::make("name","Имя"),
                TD::make("year","Год"),
                TD::make("type","Тип")->render(function (Film $film){
                    return $film->type === "movie" ? "Фильм" : "Сериал";
                }),
                TD::make("watched","Просмотрено")->render(function (Film $film){
                    return $film->watched === 0 ? "Не просмотрено" : "Просмотрено";
                })
            ]),
            Layout::modal("appendMovie",Layout::rows([
                Input::make('film')->required()->type("text")->title('Имя'),
                Input::make('year')->required()->type("text")->title('Год'),
                Select::make("type")->options([
                    'movie' => 'Фильм',
                    'tv_show' => 'Сериал',
                ]),
                Select::make("watched")->options([
                    '1' => 'Посмотрено',
                    '0' => 'Не посмотрено',
                ]),
            ]))->title("Создание задания")->applyButton("Добавить")->closeButton("Отмена"),
        ];
    }

    public function setmovie (Request $request)
    {
        echo "setmovie";
        dd($request->all());
        Film::create($request->all());
        
        //return view("setmovie",compact(""));
    }
}
