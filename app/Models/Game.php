<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Game extends Model
{
    protected $table = 'games';

    protected $fillable = [
        'provider_id',
        'game_server_url',
        'game_id',
        'game_name',
        'game_code',
        'game_type',
        'description',
        'cover',
        'status',
        'technology',
        'has_lobby',
        'is_mobile',
        'has_freespins',
        'has_tables',
        'only_demo',
        'rtp',
        'distribution',
        'views',
        'is_featured',
        'show_home',
        'ikincilmi',
        'url',
        'turnuva',
        'jackpot',
        'freespin',
        'drop',
        'populer',
        'eniyi',
        'megaways',
        'demolink',
    ];

    protected $dates = ['created_at', 'updated_at'];

    public function provider()
    {
        return $this->belongsTo(Provider::class, 'provider_id');
    }
}
