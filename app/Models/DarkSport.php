<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DarkSport extends Model
{
    protected $table = 'dark_sports';

    protected $fillable = [
        'sportid',
        'name',
        'live',
        'coupon_limit',
        'icon',
        'status',
        'listindex',
    ];
}
