<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AdminRolePermission extends Model
{
    protected $table = 'admin_role_permissions';
    protected $fillable = [
        'user_id',
        'permission_id',
    ];
}
