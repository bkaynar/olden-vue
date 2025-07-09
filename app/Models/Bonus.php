<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Bonus extends Model
{
    protected $table = 'bonuses';
    protected $fillable = [
        'bonus_name',
        'bonus_image',
        'bonus_description',
        'bonus_amount',
        'maxtutar',
        'deneme',
        'hosgeldin',
        'yuzde',
        'cevrim',
        'kayip',
        'yatirim',
        'altlimit',
        'created_at',
        'aktif',
    ];
}
