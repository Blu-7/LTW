<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    protected $fillable = [
        'name',
        'description',
        'deleted',
        'poster',
        'start_date',
        'end_date',
        'slug',
        'status',
    ];

    public function getRouteKeyName()
    {
        return 'slug';
    }
}
