<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckPermission
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, $permission)
    {
        if (!auth()->user() || !auth()->user()->hasPermissionTo($permission)) {
            abort(403, 'Bu sahifaga kirish uchun ruxsat yo‘q.');
        }

        return $next($request);
    }
}
