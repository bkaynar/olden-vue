<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Duyuru extends Model
{
    protected $table = 'duyuru';

    protected $fillable = [
        'resim',
        'url',
        'konu',
        'aciklama',
        'created_at',
    ];

    protected $dates = ['created_at'];
}
