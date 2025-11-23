<?php

declare(strict_types=1);

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

final class HasWorkspace
{
    public function handle(Request $request, Closure $next): mixed
    {
        if (! $request->user()->adminWorkspaces()->exists()) {
            return to_route('dashboard.workspaces.create');
        }

        return $next($request);
    }
}
