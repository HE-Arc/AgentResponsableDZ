<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Plane extends Model
{
    use HasFactory;

    protected $fillable = [
        'model',
        'registration',
        'seat_count',
        'picture',
    ];

    public function flights()
    {
        return $this->hasMany(Flight::class);
    }
}
