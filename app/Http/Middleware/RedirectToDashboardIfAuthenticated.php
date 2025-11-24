<?php

declare(strict_types=1);

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\RedirectIfAuthenticated;
use Illuminate\Http\Request;

final class RedirectToDashboardIfAuthenticated extends RedirectIfAuthenticated
{
    protected function redirectTo(Request $request): ?string
    {
        return route('dashboard.tickets.index');
    }
}
