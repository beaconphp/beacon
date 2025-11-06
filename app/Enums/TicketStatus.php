<?php

declare(strict_types=1);

namespace App\Enums;

enum TicketStatus: string
{
    case OPEN = 'open';
    case IN_PROGRESS = 'in_progress';
    case RESOLVED = 'resolved';
    case CLOSED = 'closed';

    public function label(): string
    {
        return match ($this) {
            self::OPEN => 'Open',
            self::IN_PROGRESS => 'In Progress',
            self::RESOLVED => 'Resolved',
            self::CLOSED => 'Closed'
        };
    }

    public function color(): ?string
    {
        return match ($this) {
            self::OPEN => 'blue',
            self::IN_PROGRESS => 'pink',
            self::RESOLVED => 'lime',
            default => null,
        };
    }
}
