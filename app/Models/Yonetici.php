<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Yonetici extends Model
{
    protected $table = 'yoneticiler';

    protected $fillable = [
        'kullanici_adi',
        'sifre',
        'eposta',
        'yetki',
        'olusturulma_tarihi',
    ];

    protected $dates = ['olusturulma_tarihi'];
}
