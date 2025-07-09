<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AdminBan extends Model
{
    protected $table = 'admin_bans';
    protected $fillable = [
        'yonetici_id',
        'kullanici_id',
        'not',
        'tarih',
    ];
}
