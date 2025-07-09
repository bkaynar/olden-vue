<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BonusClaim extends Model
{
    protected $table = 'bonus_claims';
    protected $fillable = [
        'user_id',
        'username',
        'bonus_id',
        'bonus_name',
        'bonus_amount',
        'claimed_at',
    ];
}
