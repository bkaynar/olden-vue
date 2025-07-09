<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $table = 'messages';

    protected $fillable = [
        'uye',
        'mesajturu',
        'baslik',
        'icerik',
        'goruldu',
        'created_at',
    ];

    protected $dates = ['created_at'];
}
