<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DarkLeague extends Model
{
    protected $table = 'dark_leagues';

    protected $fillable = [
        'leaguesid',
        'name',
        'live',
        'coupon_limit',
        'countryid',
        'sportid',
        'status',
        'listindex',
        'popular',
    ];
}
