<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    //TODO remove this class and refactor
    use HasFactory;

    protected $fillable = [
        "title",
        "pages",
        "quantity"
    ];
}
