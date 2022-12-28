<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;
use Orchid\Alert\Alert;

class TaskController extends Controller
{

    public function deltask ($id)
    {
        \alert("DONE");

        Task::where([
            ["id",$id],
            ["status","done"]
        ])->delete();



        return redirect(URL::previous());
        //return redirect()->route("platform.tasks");
    }
}

