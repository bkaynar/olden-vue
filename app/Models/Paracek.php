<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Paracek extends Model
{
    protected $table = 'paracek';

    protected $fillable = [
        'uye',
        'banka',
        'miktar',
        'tarih',
        'durum',
        'turu',
        'aciklama',
        'notttttt',
        'sube',
        'hesap',
        'iban',
        'created_at',
        'updated_at',
        'firma_key',
        'token',
        'user_id',
        'name',
        'telefon',
        'email',
    ];

    protected $dates = ['tarih', 'created_at', 'updated_at'];
}
