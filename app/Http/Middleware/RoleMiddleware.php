<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    // public function handle(Request $request, Closure $next): Response
    // {
    //     return $next($request);
    // }

   
      public function handle(Request $request, Closure $next, ...$roles)
    {
        // cek sudah login atau belum
        if (!Auth::check()) {
            abort(403, 'Silakan login');
        }

        // ambil user login
        $user = Auth::user();

        // cek role
        if (!in_array($user->role, $roles)) {
            abort(403, 'Tidak punya akses');
        }

        return $next($request);
    }
}
