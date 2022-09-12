<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Orchid\Screen\AsSource;

class Film extends Model
{
    use HasFactory;
    use AsSource;

    protected $fillable = ['name','year','type','watched'];
}
