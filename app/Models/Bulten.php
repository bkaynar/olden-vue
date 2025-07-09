<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Bulten extends Model
{
    protected $table = 'bulten';
    protected $fillable = [
        'eventid',
        'botid',
        'pluskod',
        'hitit_kod',
        'baslangic',
        'evsahibi_isim',
        'misafir_isim',
        'lig_isim',
        'lig_id',
        'ulke_isim',
        'ulke_id',
        'ligresim',
        'mackodu',
        'istatistik',
        'oran_adet',
        'tur',
        'tip',
        'oran1',
        'oran0',
        'oran2',
        'sportid',
        'mbs',
        'countrySlug',
        'manuelmi',
    ];
}
