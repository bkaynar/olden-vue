<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    protected $table = 'admin';

    // Laravel'in otomatik timestamp'lerini devre dışı bırak
    public $timestamps = false;

    protected $fillable = [
        'username',
        'password',
        'name',
        'email',
        'bakiye',
        'parabirimi',
        'durum',
        'sifresi',
        'telefon',
        'postakodu',
        'ulke',
        'il',
        'ilce',
        'dt',
        'tc',
        'spor',
        'casino',
        'cekim',
        '2factor',
        'aff',
        'bayisi',
        'songirisi',
        'kayit_ip',
        'kayit_tarih',
        'cevrim',
        'songiris',
        'songirisip',
    ];

    protected $dates = ['dt', 'kayit_tarih'];
}
