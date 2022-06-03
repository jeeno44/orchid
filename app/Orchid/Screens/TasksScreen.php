<?php

namespace App\Orchid\Screens;

use App\Models\Task;
use Illuminate\Http\Request;
use Orchid\Screen\Actions\ModalToggle;
use Orchid\Screen\Fields\DateTimer;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Screen;
use Orchid\Screen\TD;
use Orchid\Support\Facades\Layout;
use Orchid\Screen\Actions\Link;
use Orchid\Support\Facades\Toast;

class TasksScreen extends Screen
{
    /**
     * Query data.
     *
     * @return array
     */
    public function query(): iterable
    {
        return [
            'tasks' => Task::orderBy("datetime")->get()
        ];
    }

    /**
     * Display header name.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return 'Все задачи';
    }

    /**
     * Button commands.
     *
     * @return \Orchid\Screen\Action[]
     */
    public function commandBar(): iterable
    {
        return [
            ModalToggle::make("Редактировать задание")->modal("editTask")->method("edittask"),
            ModalToggle::make("Добавить задание")->modal("appendTask")->method("settask"),
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
            Layout::table('tasks',[
                TD::make('id'),
                TD::make('task'),
                TD::make('datetime'),
                TD::make('status')->sort(),
                TD::make('id','Delete')->render(function(Task $task){
return Link::make($task->id)
->href('deltask/'.$task->id);

}),
                TD::make('created_at'),
                TD::make('updated_at'),
            ]),
            Layout::modal("appendTask",Layout::rows([
                Input::make('task')->required()->type("text")->title('Задание'),
                DateTimer::make('datetime')->required()->title('Установить дату и время')->format24hr()->enableTime(),
            ]))->title("Создание задания")->applyButton("Добавить")->closeButton("Отмена"),
            Layout::modal("editTask",Layout::rows([
                Input::make("")->type("file")
            ]))
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

        Toast::info("Задача успешно добавлена");

        //return redirect()->route('platform.tasks');
        //return view("settask",compact(""));
    }
}
