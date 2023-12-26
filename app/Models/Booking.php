<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    protected $fillable = [
        'status',
        'date',
        'seat',
        'deleted',
        'user_id',
        'show_id',
        'payment_id',
    ];
}
