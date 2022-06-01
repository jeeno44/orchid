<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TaskController extends Controller
{
    //

    public function settask ($task,$datetime)
    {

$message = "site gosuslugi";

	$url = "https://api.telegram.org/bot5594975307:AAFNLNLO06Gdvpp-3P4NbdmN1BYil5aLnDA/sendMessage?text=".$message."&chat_id=381581718";

	file_get_contents($url);

	return "settadk";

    }
}

