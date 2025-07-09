<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KuponMac extends Model
{
    protected $table = 'kupon_mac';

    protected $fillable = [
        'oranid',
        'kuponid',
        'userid',
        'oran',
        'tur',
        'macid',
        'sonuc',
        'tarih',
        'canli',
        'session_id',
        'canlidakika',
        'skor',
        'iptal',
        'aciklamasi',
        'orangrup',
        'evsahibi',
        'deplasman',
        'mackodu',
        'sport_id',
        'matchdate',
        'result',
        'canliskor',
        'botid',
    ];

    protected $dates = ['tarih'];
}
