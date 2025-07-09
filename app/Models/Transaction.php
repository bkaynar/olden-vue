<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $table = 'transactions';

    protected $fillable = [
        'user_id',
        'type',
        'amount',
        'created_at',
        'gamename',
        'transactionid',
        'gameid',
        'session_id',
    ];

    protected $dates = ['created_at'];
}
