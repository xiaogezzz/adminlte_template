<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Models\Role;
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

    protected static function boot()
    {
        parent::boot();
        static::deleting(function ($admin) {
            $role = Role::findByName('Super Admin');
            $users = $role->users;
            if ($users->count() < 1) {
                throw new \Exception('无法删除超级管理员');
            }
        });
    }

    // 后台用户头像
    public function adminlte_image()
    {
        return asset('admin/assets/img/avatar.png');
    }
}
