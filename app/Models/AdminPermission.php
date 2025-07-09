<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AdminPermission extends Model
{
    protected $table = 'admin_permissions';
    protected $fillable = [
        'permission_name',
    ];
}
