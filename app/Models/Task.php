<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Orchid\Screen\AsSource;

class Task extends Model
{
    use HasFactory;
    use AsSource;

    protected $fillable = ['task','datetime','status','repeat'];

    protected $allowedSorts = [
        'task',
        'status',
    ];

    protected $allowFilters = [
        'task',
        'status',
    ];

}
