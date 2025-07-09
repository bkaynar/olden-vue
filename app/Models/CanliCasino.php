<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CanliCasino extends Model
{
    protected $table = 'canli_casino';

    protected $fillable = [
        'gorsel',
        'url',
        'sira',
    ];
}
