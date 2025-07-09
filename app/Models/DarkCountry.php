<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DarkCountry extends Model
{
    protected $table = 'dark_country';

    protected $fillable = [
        'countryid',
        'name',
        'live',
        'coupon_limit',
        'slug',
        'sportid',
        'status',
        'listindex',
    ];
}
