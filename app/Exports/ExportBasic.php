<?php

namespace App\Exports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithHeadingRow;


class ExportBasic implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */

    //use Exportable;

    public function collection()
    {
      //  return User::all();

        $users = User::get("id","name","email");

        //return $users;

        //return view('excel', compact('users'));
    }

    public function view ():View
    {
        $users = User::all();

        return view('excel', compact('users'));
    }
}
