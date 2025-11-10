<?php

declare(strict_types=1);

namespace App\Enums;

enum UserRole: string
{
    case CLIENT = 'client';
    case ADMIN = 'admin';
    case OWNER = 'owner';

    public static function availableForCreate(): array
    {
        return array_filter(
            self::cases(),
            fn (self $role): bool => $role !== self::OWNER
        );
    }

    public function label(): string
    {
        return match ($this) {
            self::OWNER => 'Owner',
            self::ADMIN => 'Admin',
            self::CLIENT => 'Client',
        };
    }
}
