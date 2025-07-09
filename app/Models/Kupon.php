<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kupon extends Model
{
    protected $table = 'kupon';

    protected $fillable = [
        'userid',
        'ad',
        'miktar',
        'oran',
        'tarih',
        'durum',
        'sil',
        'kesim',
        'odeme',
        'iptal',
        'ip',
        'odendi',
        'canli',
        'sonmactarih',
        'toplam',
        'kazanan',
        'skontrol',
        'bonus',
        'numara',
    ];

    protected $dates = ['tarih'];
}
