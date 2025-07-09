<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OddsType extends Model
{
    protected $table = 'odds_types';

    protected $fillable = [
        'name',
    ];
}
