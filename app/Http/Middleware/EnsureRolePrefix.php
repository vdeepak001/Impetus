<?php

namespace App\Http\Middleware;

use App\Helpers\MenuHelper;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureRolePrefix
{
    /**
     * Ensure the request is for the given role prefix (user's role must match URL prefix).
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, string $prefix): Response
    {
        $user = $request->user();
        $expectedRolePrefix = MenuHelper::getPrefixForRole($user?->role_type);

        if (! $user || $expectedRolePrefix !== $prefix) {
            return $expectedRolePrefix
                ? redirect()->route($expectedRolePrefix.'.dashboard')
                : redirect()->route('login');
        }

        return $next($request);
    }
}
