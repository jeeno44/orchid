<?php

namespace App\Http\Controllers;

use App\Models\Film;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;

class FilmsController extends Controller
{
    public function delfilm ($id)
    {
        Film::where("id",$id)->delete();

        return redirect(URL::previous());
    }
}
