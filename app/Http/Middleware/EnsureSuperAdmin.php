<?php

namespace App\Http\Middleware;

use App\Helpers\MenuHelper;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureSuperAdmin
{
    /**
     * Handle an incoming request. Only super admin users may access admin-users routes.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = $request->user();
        if (! $user || $user->role_type !== 'superadmin') {
            $prefix = MenuHelper::getPrefixForRole($user?->role_type);

            return $prefix
                ? redirect()->route($prefix.'.dashboard')
                : redirect()->route('login');
        }

        return $next($request);
    }
}
