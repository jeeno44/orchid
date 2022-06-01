<?php

namespace App\Orchid\Screens;

use App\Models\Task;
use Illuminate\Http\Request;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Fields\DateTimer;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Layout;
use Orchid\Screen\Screen;

class SettaskScreen extends Screen
{
    /**
     * Query data.
     *
     * @return array
     */
    public function query(): iterable
    {
        return [];
    }

    /**
     * Display header name.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return 'SettaskScreen';
    }

    /**
     * Button commands.
     *
     * @return \Orchid\Screen\Action[]
     */
    public function commandBar(): iterable
    {
        return [
            Button::make('Send')->method("settask")
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
            \Orchid\Support\Facades\Layout::rows([
              Input::make('task')->type('text')->title("Добавить задание"),
                DateTimer::make('datetime')->title('Установить дату и время')->format24hr()->enableTime(),
            ])
        ];
    }

    public function settask (Request $request)
    {
        $rules=[
            'task'=>['required','min:5'],
            'datetime'=>['required'],
        ];

        $this->validate($request,$rules);

        Task::create([
            "task" => $request->task,
            "datetime" => $request->datetime,
        ]);

        return redirect()->back();
        //return view("settask",compact(""));
    }
}
