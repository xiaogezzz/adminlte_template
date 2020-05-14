<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;

class Admin extends Authenticatable
{
    use HasRoles;

    protected $fillable = [
        'name', 'nickname', 'password', 'avatar'
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];
}
