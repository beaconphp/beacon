<?php

declare(strict_types=1);

use App\Models\User;

if (! function_exists('current_user')) {
    function current_user(): ?User
    {
        return auth()->user();
    }
}
