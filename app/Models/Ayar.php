<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ayar extends Model
{
    protected $table = 'ayarlar';
    protected $fillable = [
        'casinolimit',
        'site_adi',
        'site_aciklama',
        'site_kelimeler',
        'footer_desc',
        'site_durum',
        'homespor',
        'logo',
        'favicon',
        'telegram',
        'instagram',
        'twitter',
        'smsadet',
        'dogrulama',
        'yoneticicode',
    ];
}
