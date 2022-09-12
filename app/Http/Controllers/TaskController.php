<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;

class TaskController extends Controller
{

    public function deltask ($id)
    {
        Task::where("id",$id)->delete();

        return redirect(URL::previous());
        //return redirect()->route("platform.tasks");
    }
}

