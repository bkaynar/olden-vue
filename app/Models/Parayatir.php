<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Parayatir extends Model
{
    protected $table = 'parayatir';

    protected $fillable = [
        'uye',
        'adsoyad',
        'tc',
        'banka',
        'islemno',
        'miktar',
        'tur',
        'aciklama',
        'tarih',
        'durum',
        'bonus',
        'note',
    ];

    protected $dates = ['tarih'];
}
