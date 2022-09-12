<?php

namespace App\Orchid\Screens;

use App\Models\Film;
use Orchid\Screen\Actions\ModalToggle;
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
            //ModalToggle::make("Добавить задание")->modal("appendTask")->method("settask"),
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
                TD::make("id"),
                TD::make("name"),
                TD::make("year"),
                TD::make("type"),
                TD::make("watched"),
            ])
        ];
    }
}
