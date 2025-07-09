<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OddService extends Model
{
    protected $table = 'odd_services';

    protected $fillable = [
        'betsapitechkey',
        'name',
        'list',
        'odds',
        'active',
        'created_at',
        'updated_at',
    ];

    protected $dates = ['created_at', 'updated_at'];
}
