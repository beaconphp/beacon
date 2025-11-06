<?php

declare(strict_types=1);

namespace App\Enums;

enum TicketPriority: string
{
    case NORMAL = 'normal';
    case LOW = 'low';
    case MEDIUM = 'medium';
    case HIGH = 'high';

    public function label(): string
    {
        return match ($this) {
            self::NORMAL => 'Normal',
            self::LOW => 'Low',
            self::MEDIUM => 'Medium',
            self::HIGH => 'High',
        };
    }
}
