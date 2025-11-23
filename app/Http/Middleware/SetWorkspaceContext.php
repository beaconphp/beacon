<?php

declare(strict_types=1);

namespace App\Http\Middleware;

use App\Models\Workspace;
use Closure;
use Illuminate\Http\Request;

final class SetWorkspaceContext
{
    public function handle(Request $request, Closure $next): mixed
    {
        $workspaceSlug = $request->route('workspace', false);

        abort_unless($workspaceSlug, 404);

        $workspace = Workspace::query()->where('slug', $workspaceSlug)->firstOrFail();

        view()->share('currentWorkspace', $workspace);

        return $next($request);
    }
}
