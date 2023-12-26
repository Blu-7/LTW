<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Show extends Model
{
    protected $fillable = [
        'name',
        'deleted',
        'poster',
        'date',
        'time',
        'status',
        'movie_id',
    ];
}
