<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\RoleRequest;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolesController extends Controller
{
    public function index(Request $request)
    {
        $keywords = $request->input('search', '');
        $list = Role::query()
            ->when($keywords, function (Builder $query) use ($keywords) {
                return $query->where('name', 'like', '%' . $keywords . '%')
                    ->orWhere('display_name', 'like', '%' . $keywords . '%');
            })
            ->latest()
            ->orderBy('id', 'desc')
            ->paginate(10);

        $permissions = Permission::all();
        return view('admin.role.index', compact('list', 'permissions', 'keywords'));
    }

    public function store(RoleRequest $request)
    {
        \DB::transaction(function () use ($request) {
            $role = Role::create($request->except('permissions'));
            $role->syncPermissions($request->input('permissions'));
        });

        return self::success();
    }

    public function edit(Role $role)
    {
        $permissions = Permission::all();
        return view('admin.role.edit', compact('role', 'permissions'));
    }

    public function update(Role $role, RoleRequest $request)
    {
        \DB::transaction(function () use ($role, $request) {
            $role->fill($request->except('permissions'));
            $role->save();
            $role->syncPermissions($request->input('permissions'));
        });

        return self::success();
    }

    public function destroy(Role $role)
    {
        abort_if($role->name == 'Super Admin', 500, '无法删除超级管理员');

        \DB::transaction(function () use ($role) {
            $role->syncPermissions([]);
            $role->delete();
        });

        return self::success();
    }
}
