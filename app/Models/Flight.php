<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Flight extends Model
{
    use HasFactory;


    protected $fillable = [
        'plane_id',
        'departure',
    ];

    /**
     * The users that belong to the Flight
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function users()
    {
        return $this->belongsToMany(User::class);
    }

    public function plane(){
        return $this->belongsTo(Plane::class);
    }
}
