<?php

namespace App\Orchid\Screens;

use App\Models\Task;
use Orchid\Screen\Screen;
use Orchid\Screen\TD;
use Orchid\Support\Facades\Layout;
use Orchid\Screen\Actions\Link;

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
        return [];
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
                TD::make('status'),
                TD::make('id','Delete')->render(function(Task $task){
return Link::make($task->id)
->href('deltask/'.$task->id);

}),
                TD::make('created_at'),
                TD::make('updated_at'),
            ])
        ];
    }
}
