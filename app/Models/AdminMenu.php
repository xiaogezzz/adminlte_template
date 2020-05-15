<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AdminMenu extends Model
{
    protected $fillable = [
        'parent_id',
        'order',
        'title',
        'icon',
        'uri',
        'permission',
    ];

    public function subMenus()
    {
        return $this->hasMany(AdminMenu::class, 'parent_id');
    }
}
