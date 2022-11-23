<?php

namespace App\Http\Controllers;

use App\Jobs\RabbitJob;
use Illuminate\Http\Request;

class RabbitController extends Controller
{
    public function SendText ()
    {
        RabbitJob::dispatch("")->onQueue("text");
    }
}
