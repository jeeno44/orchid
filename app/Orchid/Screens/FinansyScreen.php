<?php

namespace App\Orchid\Screens;

use App\Models\Finans;
use Carbon\Carbon;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Actions\ModalToggle;
use Orchid\Screen\Fields\DateTimer;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Screen;
use Orchid\Screen\TD;
use Orchid\Support\Facades\Layout;

class FinansyScreen extends Screen
{
    /**
     * Query data.
     *
     * @return array
     */
    public function query(): iterable
    {

        return [
            "fins" => Finans::all()
//            "fins" => Finans::orderBy("id
        ];
    }

    /**
     * Display header name.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return 'Учёт финансов';
    }

    /**
     * Button commands.
     *
     * @return \Orchid\Screen\Action[]
     */
    public function commandBar(): iterable
    {
        return [
//            ModalToggle::make("Добавить учёт")->modal("appendFins")->method("setfin"),
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
            /*Layout::table('fins',[
                TD::make('id')->width(55),/*
                TD::make('date')->sort()->filter(),
                TD::make('name')->sort()->filter(),
                TD::make('price')->sort()->filter(),*/
            //])
            /*Layout::modal("appendTask",Layout::rows([
                Input::make('task')->required()->type("text")->title('Задание'),
                DateTimer::make('datetime')->required()->title('Установить дату и время')->format24hr()->enableTime(),
            ]))->title("Создание задания")->applyButton("Добавить")->closeButton("Отмена"),*/

        ];
    }
}
