<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\MenuRequest;
use App\Models\AdminMenu;
use Illuminate\Http\Request;

class MenusController extends Controller
{
    public function index(Request $request, AdminMenu $menu)
    {
        $list = $menu::query()
            ->orderBy('parent_id')
            ->orderBy('order')
            ->latest()
            ->orderBy('id', 'desc')
            ->get();

        $options = $menu::selectOptions();

        return view('admin.menu.index', compact('list', 'options'));
    }

    public function store(MenuRequest $request)
    {
        $menu = new AdminMenu($request->all());
        $menu->save();
        return self::success();
    }

    public function edit(AdminMenu $menu)
    {
        $options = $menu::selectOptions();
        return view('admin.menu.edit', compact('menu', 'options'));
    }

    public function update(AdminMenu $menu, MenuRequest $request)
    {
        $menu->fill($request->all());
        $menu->save();
        return self::success();
    }

    public function destroy(AdminMenu $menu)
    {
        $menu->delete();
        return self::success();
    }
}
