<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\PermissionRequest;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;

class PermissionsController extends Controller
{
    public function index(Request $request)
    {
        $keywords = $request->input('search', '');
        $list = Permission::query()
            ->when($keywords, function (Builder $query) use ($keywords) {
                return $query->where('name', 'like', '%' . $keywords . '%')
                    ->orWhere('nickname', 'like', '%' . $keywords . '%');
            })
            ->latest()
            ->orderBy('id', 'desc')
            ->paginate(10);

        return view('admin.permission.index', compact('list', 'keywords'));
    }

    public function store(PermissionRequest $request)
    {
        Permission::create($request->all());
        return self::success();
    }

    public function edit(Permission $permission)
    {
        return view('admin.permission.edit', compact('permission'));
    }

    public function update(Permission $permission, PermissionRequest $request)
    {
        $permission->fill($request->all());
        if ($permission->save()) {
            return self::success();
        }
        return self::error();
    }
}
