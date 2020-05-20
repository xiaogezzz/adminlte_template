<?php

namespace App\Http\Middleware;

use Closure;

class CheckAdminPermission
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        //如果用户没有操作权限
        if (!auth('admin')->user()->can($request->route()->getName())) {

            //如果是ajax请求没有权限
            if ($request->expectsJson()) {
                $error = [
                    'msg' => '您没有操作此资源的权限<br/>请联系管理员',
                    'status' => 403,
                    'code' => -1,
                    'field' => ''
                ];
                return response()->json($error);
            }

            //普通http请求没有权限
            return response()->view('admin.403');
        }

        return $next($request);
    }
}
