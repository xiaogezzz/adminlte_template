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
                'icon' => 'fa-dashboard',
                'uri' => '/',
                'permission' => 'index',
            ],
            [
                'order' => 2,
                'parent_id' => 0,
                'title' => '系统管理',
                'icon' => 'fa-tasks',
                'uri' => '',
                'permission' => '',
            ],
            [
                'parent_id' => 2,
                'order' => 3,
                'title' => '管理员',
                'icon' => 'fa-users',
                'uri' => 'admin/admins',
                'permission' => 'admins.index',
            ],
            [
                'parent_id' => 2,
                'order' => 4,
                'title' => '角色',
                'icon' => 'fa-user',
                'uri' => 'admin/roles',
                'permission' => 'roles.index',
            ],
            [
                'parent_id' => 2,
                'order' => 5,
                'title' => '权限',
                'icon' => 'fa-ban',
                'uri' => 'admin/permissions',
                'permission' => 'permissions.index',
            ],
            [
                'parent_id' => 2,
                'order' => 6,
                'title' => '菜单',
                'icon' => 'fa-bars',
                'uri' => 'admin/menu',
                'permission' => 'menus.index',
            ],
            [
                'parent_id' => 2,
                'order' => 7,
                'title' => '操作日志',
                'icon' => 'fa-history',
                'uri' => 'admin/logs',
                'permission' => 'logs.index',
            ],
        ]);
    }
}
