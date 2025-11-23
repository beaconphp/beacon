<?php

declare(strict_types=1);

namespace App\Observers;

use App\Mail\TicketAssigned;
use App\Models\Ticket;
use Illuminate\Support\Facades\Mail;

final class TicketObserver
{
    /**
     * Handle the Ticket "created" event.
     */
    public function created(Ticket $ticket): void
    {
        if ($ticket->assignee?->email) {
            Mail::to($ticket->assignee->email)->send(new TicketAssigned($ticket));
        }
    }

    /**
     * Handle the Ticket "updated" event.
     */
    public function updated(Ticket $ticket): void
    {
        if ($ticket->wasChanged('assignee_id') && $ticket->assignee?->email) {
            Mail::to($ticket->assignee->email)->send(new TicketAssigned($ticket));
        }
    }
}
