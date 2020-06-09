<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\OperationLog;
use Illuminate\Http\Request;

class LogsController extends Controller
{
    public function index(Request $request, OperationLog $log)
    {
        $keywords = $request->input('search', '');
        $list = $log::query()
            ->latest()
            ->orderBy('id', 'desc')
            ->paginate(20);

        return view('admin.log.index', compact('list', 'keywords'));
    }

    public function destroy()
    {

    }
}
