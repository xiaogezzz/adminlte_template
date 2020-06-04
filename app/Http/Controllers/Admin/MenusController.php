<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AdminMenu;
use Illuminate\Database\Eloquent\Builder;
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
}
