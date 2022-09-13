<?php

namespace App\Orchid\Screens;

use App\Models\Task;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Orchid\Screen\Fields\Group;
use Request as Rq;
use Illuminate\Pagination\Paginator;
use Orchid\Screen\Actions\ModalToggle;
use Orchid\Screen\Fields\DateTimer;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Upload;
use Orchid\Screen\Screen;
use Orchid\Screen\TD;
use Orchid\Support\Facades\Layout;
use Orchid\Screen\Actions\Link;
use Orchid\Support\Facades\Toast;
use Orchid\Attachment\File;

class TasksScreen extends Screen
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
            //'lask' => Task::find(19),
            'tasks' => Task::orderBy("datetime")->paginate(30),
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
                TD::make('id')->width(55),
                TD::make('task')->sort()->filter(),
                TD::make('datetime')->width(155),
                TD::make('status')->width(100)->sort(),
                TD::make('Edit')->render(function(Task $task){
                    return ModalToggle::make("Редакторовать")
                        ->modal("editTask")
                        ->method("edittask")
                        ->modalTitle("Редактировать задание ".$task->task)
                        ->asyncParameters([
                            'task' => $task->id
                        ]);
                }),
                TD::make('id','Delete')->width(100)->align(TD::ALIGN_RIGHT)->render(function(Task $task){
return Link::make($task->id)
->href('deltask/'.$task->id);

}),
                TD::make('created_at')->width(160)->defaultHidden()->render(function(Task $task){
                    $dt = Carbon::create($task->created_at);
                    return $dt->format("d.m.Y H:i");
                }),
                TD::make('updated_at')->width(160)->defaultHidden()->render(function(Task $task){
                    $dt = Carbon::create($task->created_at);
                    return $dt->format("d.m.Y H:i");
                }),
            ]),

            Layout::modal("appendTask",Layout::rows([
                Input::make('task')->required()->type("text")->title('Задание'),
                DateTimer::make('datetime')->required()->title('Установить дату и время')->format24hr()->enableTime(),
            ]))->title("Создание задания")->applyButton("Добавить")->closeButton("Отмена"),
            Layout::modal("editTask",Layout::rows([
                //Upload::make('proto')->title("Загрузка")
                Input::make("task.id")->type('hidden'),
                Input::make("task.task"),
//                Input::make("lask.datetime"),
                DateTimer::make('task.datetime')->required()->title('Установить дату и время')->format24hr()->enableTime(),
            ]))->async('asyncGetTask')
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
    }

    public function edittask (Request $request)
    {
        Task::where("id",$request->task['id'])->update([
            "id" => $request->task["id"],
            "task" => $request->task["task"],
            "datetime" => $request->task["datetime"],
            "status" => "active",
        ]);
    }

    public function asyncGetTask (Task $task): array
    {
        return [
            "task" => $task,
        ];
    }
}
