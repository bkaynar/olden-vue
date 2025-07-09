<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Provider extends Model
{
    protected $table = 'providers';

    protected $fillable = [
        'cover',
        'code',
        'name',
        'image',
        'status',
        'rtp',
        'views',
        'distribution',
        'created_at',
        'updated_at',
    ];

    protected $dates = ['created_at', 'updated_at'];
}
