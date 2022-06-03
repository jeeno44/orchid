<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{

    public function deltask ($id)
    {
        Task::where("id",$id)->delete();
        return redirect()->route("platform.tasks");
    }
}

