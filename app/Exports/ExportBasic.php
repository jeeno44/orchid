<?php

namespace App\Exports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\FromCollection;

class ExportBasic implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return User::all();

        //$users = User::where("id",">",0)->get();

        //return view('excel', compact('users'));
    }
}