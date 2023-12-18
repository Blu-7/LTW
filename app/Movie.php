<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    protected $fillable = [
        'name',
        'created_at',
        'updated_at',
        'description',
        'deleted',
        'poster',
        'content',
        'active',
        'start_date',
        'end_date',
        'slug'
    ];
}
