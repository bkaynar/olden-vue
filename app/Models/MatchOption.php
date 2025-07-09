<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MatchOption extends Model
{
    protected $table = 'match_options';

    protected $fillable = [
        'eventid',
        'option_type',
        'option_value',
        'odds',
    ];
}
