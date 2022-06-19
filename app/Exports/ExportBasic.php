<?php

namespace App\Exports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithHeadingRow;


class ExportBasic implements FromCollection,WithHeadingRow
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return User::all();

        //$users = User::where("id",">",0)->get();

        //return $users;

        //return view('excel', compact('users'));
    }

    /*public function view ():View
    {
        $users = User::all();

        return view('excel', compact('users'));
    }*/
}
