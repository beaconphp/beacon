<?php

declare(strict_types=1);

use App\Models\User;
use App\Models\Workspace;

if (! function_exists('current_user')) {
    function current_user(): ?User
    {
        return auth()->user();
    }
}

if (! function_exists('current_workspace')) {
    function current_workspace(): ?Workspace
    {
        return current_user()?->currentWorkspace;
    }
}
