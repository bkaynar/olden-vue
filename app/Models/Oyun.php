<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Oyun extends Model
{
    protected $table = 'oyunlar';

    protected $fillable = [
        'gorsel',
        'url',
        'sira',
    ];
}
