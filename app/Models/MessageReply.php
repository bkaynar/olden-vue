<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MessageReply extends Model
{
    protected $table = 'message_replies';

    protected $fillable = [
        'message_id',
        'user_id',
        'content',
        'created_at',
    ];

    protected $dates = ['created_at'];
}
