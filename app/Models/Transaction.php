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

    public function user()
    {
        return $this->belongsTo(Admin::class, 'user_id');
    }

    public function game()
    {
        // Transaction.gameid -> Game.game_id
        return $this->belongsTo(Game::class, 'gameid', 'game_id');
    }
}
