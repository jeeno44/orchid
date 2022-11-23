<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\FilmsController;
use Illuminate\Http\Client\Request as REQ;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

/*Route::get('flex',function (){

    return view("flex");

});*/

Route::get('/admin/deltask/{id}', [TaskController::class, 'deltask']);

Route::get('/admin/delfilm/{id}', [FilmsController::class, 'delfilm']);

Route::get('export',function (){

    return \Maatwebsite\Excel\Facades\Excel::download(new \App\Exports\ExportBasic(),"users_".str_replace(" ","_",now()->toDateTimeString()).".xlsx");

})->name("export_users");

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('send/text', [\App\Http\Controllers\RabbitController::class, 'sendText']);
