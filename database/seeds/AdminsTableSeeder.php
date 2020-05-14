<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use App\Models\Admin;

class AdminsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = Admin::query()->create([
            'name' => 'admin',
            'nickname' => '超级管理员',
            'password' => Hash::make('admin@123'),
        ]);

        Role::create(['name' => 'Super Admin']);
        $admin->assignRole('Super Admin');
    }
}
