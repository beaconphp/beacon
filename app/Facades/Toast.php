<?php

declare(strict_types=1);

namespace App\Facades;

use App\Managers\ToastManager;
use Illuminate\Support\Facades\Facade;

/**
 * @see ToastManager
 */
final class Toast extends Facade
{
    public static function getFacadeAccessor(): string
    {
        return 'toast';
    }
}
