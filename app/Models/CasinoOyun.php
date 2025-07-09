<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CasinoOyun extends Model
{
    protected $table = 'casino_oyunlari';

    protected $fillable = [
        'gorsel',
        'url',
        'sira',
    ];
}
