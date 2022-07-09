<?php

namespace App\Orchid\Screens;

use App\Models\Finans;
use App\Models\Task;
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
            "finans" => Finans::all(),
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
            ModalToggle::make("Добавить запись")->modal("appendFin")->method("setfin"),
        ];
    }

    /**
     * Views.
     *
     * @return \Orchid\Screen\Layout[]|string[]
     */
    public function layout(): iterable
    {
//        dump("fins");

        return [
            Layout::table('finans',[
                TD::make('id'),
                TD::make('date')->sort()->filter(),
                TD::make('name')->sort()->filter(),
                TD::make('type')->sort()->filter(),
                TD::make('price')->sort()->filter(),
            ]),
            Layout::modal("appendFin",Layout::rows([
                Input::make('name')->required()->type("text")->title('Имя'),
//                DateTimer::make('datetime')->required()->title('Установить дату и время')->format24hr()->enableTime(),
            ]))->title("Добавить учёт")->applyButton("Добавить")->closeButton("Отмена"),


        ];
    }

    public function setfin ()
    {
        dump("OK");
    }
}
