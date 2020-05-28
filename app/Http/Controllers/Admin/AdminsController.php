<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\AdminRequest;
use App\Models\Admin;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class AdminsController extends Controller
{
    public function index(Request $request)
    {
        $roles = Role::all();
        $keywords = $request->input('search', '');
        $list = Admin::query()
            ->when($keywords, function (Builder $query) use ($keywords) {
                return $query->where('name', 'like', '%' . $keywords . '%')
                    ->orWhere('nickname', 'like', '%' . $keywords . '%');
            })
            ->latest()
            ->orderBy('id', 'desc')
            ->paginate(10);
        return view('admin.admin.index', compact('list', 'keywords', 'roles'));
    }

    public function store(AdminRequest $request)
    {
        $admin = new Admin($request->except('password'));
        $admin->password = \Hash::make($request->input('password'));
        try {
            \DB::beginTransaction();
            $admin->save();
            $admin->assignRole($request->input('roles'));
            \DB::commit();
        } catch (\Exception $e) {
            \DB::rollBack();
            return self::error($e->getMessage());
        }

        return self::success();
    }

    public function edit(Admin $admin)
    {
        $roles = Role::all();
        return view('admin.admin.edit', compact('admin', 'roles'))->render();
    }

    public function update(Admin $admin, AdminRequest $request)
    {
        $admin->fill($request->all());
        if ($request->has('password')) {
            $admin->password = \Hash::make($request->input('password'));
        }
        try {
            \DB::beginTransaction();
            $admin->save();
            $admin->syncRoles($request->input('roles'));
            \DB::commit();
        } catch (\Exception $e) {
            \DB::rollBack();
            return self::error('操作失败');
        }
        return self::redirect(route('admins.index'));
    }

    public function destroy(Admin $admin)
    {
        \DB::transaction(function () use ($admin) {
            $admin->syncRoles([]);
            $admin->delete();
        });
        return self::success();
    }
}
