<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class AdminPermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Schema::disableForeignKeyConstraints();
        Permission::query()->truncate();
        Permission::query()->insert([
            ['name' => 'index', 'guard_name' => 'admin', 'display_name' => '首页',],
            ['name' => 'admins.index', 'guard_name' => 'admin', 'display_name' => '管理员列表',],
            ['name' => 'admins.store', 'guard_name' => 'admin', 'display_name' => '新增管理员',],
            ['name' => 'admins.edit', 'guard_name' => 'admin', 'display_name' => '编辑管理员',],
            ['name' => 'admins.update', 'guard_name' => 'admin', 'display_name' => '更新编辑管理员',],
            ['name' => 'admins.destroy', 'guard_name' => 'admin', 'display_name' => '删除管理员',],

            ['name' => 'roles.index', 'guard_name' => 'admin', 'display_name' => '角色列表',],
            ['name' => 'roles.store', 'guard_name' => 'admin', 'display_name' => '新增角色',],
            ['name' => 'roles.edit', 'guard_name' => 'admin', 'display_name' => '编辑角色',],
            ['name' => 'roles.update', 'guard_name' => 'admin', 'display_name' => '更新编辑角色',],
            ['name' => 'roles.destroy', 'guard_name' => 'admin', 'display_name' => '删除角色',],

            ['name' => 'permissions.index', 'guard_name' => 'admin', 'display_name' => '权限列表',],
            ['name' => 'permissions.store', 'guard_name' => 'admin', 'display_name' => '新增权限',],
            ['name' => 'permissions.edit', 'guard_name' => 'admin', 'display_name' => '编辑权限',],
            ['name' => 'permissions.update', 'guard_name' => 'admin', 'display_name' => '更新编辑权限',],
            ['name' => 'permissions.destroy', 'guard_name' => 'admin', 'display_name' => '删除权限',],

            ['name' => 'menus.index', 'guard_name' => 'admin', 'display_name' => '菜单列表',],
            ['name' => 'menus.store', 'guard_name' => 'admin', 'display_name' => '新增菜单',],
            ['name' => 'menus.edit', 'guard_name' => 'admin', 'display_name' => '编辑菜单',],
            ['name' => 'menus.update', 'guard_name' => 'admin', 'display_name' => '更新编辑菜单',],
            ['name' => 'menus.destroy', 'guard_name' => 'admin', 'display_name' => '删除菜单',],

            ['name' => 'logs.index', 'guard_name' => 'admin', 'display_name' => '日志列表',],
            ['name' => 'logs.store', 'guard_name' => 'admin', 'display_name' => '新增日志',],
            ['name' => 'logs.destroy', 'guard_name' => 'admin', 'display_name' => '删除日志',],
        ]);
        Schema::enableForeignKeyConstraints();
    }
}
