<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Slider extends Model
{
    protected $fillable = [
        'name',
        'deleted',
        'poster',
    ];

    public function getRouteKeyName()
    {
        return 'slug';
    }
}
