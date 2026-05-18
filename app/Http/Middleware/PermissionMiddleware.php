<?php

namespace App\Http\Middleware;

use App\Models\Role;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Symfony\Component\HttpFoundation\Response;

/**
 * Registers per-permission Gates for the current user on every request,
 * and (optionally) enforces a specific permission slug when used as
 * a route middleware:  Route::get(...)->middleware('permission:user.view');
 *
 * Super-admin users always pass.
 */
class PermissionMiddleware
{
    public function handle(Request $request, Closure $next, ?string $permission = null): Response
    {
        $user = $request->user();

        // Register every permission as a Gate definition so @can() works.
        $this->registerGates();

        // Allow guests to fall through to auth middleware.
        if (! $user) {
            return $next($request);
        }

        // Super-admins bypass everything.
        if (method_exists($user, 'isSuperAdmin') && $user->isSuperAdmin()) {
            return $next($request);
        }

        // Route-level enforcement.
        if ($permission !== null && ! $user->hasPermission($permission)) {
            abort(403, __('app.not_authorized'));
        }

        return $next($request);
    }

    /**
     * Build the role-based permission map and register Gates dynamically.
     * Cached per-request via a static flag to avoid re-running on each
     * middleware invocation in the same lifecycle.
     */
    protected function registerGates(): void
    {
        static $registered = false;
        if ($registered) {
            return;
        }
        $registered = true;

        // Don't blow up before migrations have run.
        try {
            $roles = Role::with('permissions')->get();
        } catch (\Throwable $e) {
            return;
        }

        $map = [];
        foreach ($roles as $role) {
            foreach ($role->permissions as $perm) {
                $map[$perm->slug][] = $role->id;
            }
        }

        foreach ($map as $slug => $roleIds) {
            Gate::define($slug, function ($user) use ($roleIds) {
                if (method_exists($user, 'isSuperAdmin') && $user->isSuperAdmin()) {
                    return true;
                }

                return $user->roles
                    ->pluck('id')
                    ->intersect($roleIds)
                    ->isNotEmpty();
            });
        }

        // Super-admin always passes — register a global before() filter.
        Gate::before(function ($user) {
            if (method_exists($user, 'isSuperAdmin') && $user->isSuperAdmin()) {
                return true;
            }

            return null;
        });
    }
}
