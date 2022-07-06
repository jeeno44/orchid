<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Finans extends Model
{
    protected $table = "finans";

    protected $fillable = [
        "date",
        "name",
        "type",
        "count",
        "price",
    ];

    use HasFactory;
}
