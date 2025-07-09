<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CanliBulten extends Model
{
    protected $table = 'canlibulten';

    protected $fillable = [
        'mac_id',
        'sportid',
        'betradar_id',
        'skor',
        'baslangic',
        'dakika',
        'sure_detay',
        'oynuyormu',
        'aktifmi',
        'ulke',
        'ulke_id',
        'lig',
        'lig_id',
        'oran_adet',
        'tip',
        'tur',
        'evsahibi_isim',
        'misafir_isim',
    ];

    protected $dates = ['baslangic'];
}
