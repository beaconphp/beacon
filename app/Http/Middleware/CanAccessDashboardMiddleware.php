<?php

declare(strict_types=1);

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

final class CanAccessDashboardMiddleware
{
    public function handle(Request $request, Closure $next): mixed
    {
        abort_unless($request->user()?->canAccessDashboard(), 404);

        return $next($request);
    }
}
