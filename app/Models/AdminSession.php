<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AdminSession extends Model
{
    protected $table = 'admin_session';
    protected $fillable = [
        'admin_id',
        'ip',
        'browser',
        'login_time',
        'last_active',
        'os',
        'active',
    ];
}
