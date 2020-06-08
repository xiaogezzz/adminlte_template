<?php

namespace App\Http\Middleware;

use App\Models\OperationLog;
use Closure;

class LogOperation
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        /*
         * Routes that will not log to database.
         *
         * All method to path like: admin/auth/logs
         * or specific method to path like: get:admin/auth/logs.
         */
        $except_arr = [
            'manage/logs*'
        ];

        foreach ($except_arr as $except) {
            if ($except !== '/') {
                $except = trim($except, '/');
            }

            $methods = [];

            if (\Str::contains($except, ':')) {
                list($methods, $except) = explode(':', $except);
                $methods = explode(',', $methods);
            }

            $methods = array_map('strtoupper', $methods);

            if ($request->is($except) &&
                (empty($methods) || in_array($request->method(), $methods))) {
                return $next($request);
            }
        }

        $admin = auth('admin')->user();
        if ($admin) {
            $log = [
                'admin_id' => $admin->id,
                'path' => substr($request->path(), 0, 255),
                'method' => $request->method(),
                'ip' => $request->getClientIp(),
                'input' => json_encode($request->input()),
            ];

            try {
                OperationLog::query()->create($log);
            } catch (\Exception $exception) {
                // pass
            }
        }

        return $next($request);
    }
}
