<?php

use App\Models\AdminMenu;
use Illuminate\Database\Seeder;

class AdminMenusTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        AdminMenu::query()->truncate();
        AdminMenu::query()->insert([
            [
                'parent_id' => 0,
                'order' => 1,
                'title' => '首页',
                'icon' => 'nav-icon fas fa-tachometer-alt',
                'uri' => '/',
                'permission' => 'index',
            ],
            [
                'order' => 2,
                'parent_id' => 0,
                'title' => '系统管理',
                'icon' => 'nav-icon fas fa-server',
                'uri' => '',
                'permission' => '',
            ],
            [
                'parent_id' => 2,
                'order' => 1,
                'title' => '管理员',
                'icon' => 'nav-icon fas fa-users',
                'uri' => 'admins',
                'permission' => 'admins.index',
            ],
            [
                'parent_id' => 2,
                'order' => 2,
                'title' => '角色',
                'icon' => 'nav-icon fas fa-user',
                'uri' => 'roles',
                'permission' => 'roles.index',
            ],
            [
                'parent_id' => 2,
                'order' => 3,
                'title' => '权限',
                'icon' => 'nav-icon fas fa-ban',
                'uri' => 'permissions',
                'permission' => 'permissions.index',
            ],
            [
                'parent_id' => 2,
                'order' => 4,
                'title' => '菜单',
                'icon' => 'nav-icon fas fa-bars',
                'uri' => 'menu',
                'permission' => 'menus.index',
            ],
            [
                'parent_id' => 2,
                'order' => 5,
                'title' => '操作日志',
                'icon' => 'nav-icon fas fa-history',
                'uri' => 'logs',
                'permission' => 'logs.index',
            ],
        ]);
    }
}
