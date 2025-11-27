<?php

declare(strict_types=1);

namespace App\Livewire\Workspace\Tickets;

use App\Livewire\Workspace\WorkspaceComponent;
use App\Models\Ticket;
use Illuminate\View\View;
use Livewire\Attributes\Locked;

final class ShowTicket extends WorkspaceComponent
{
    #[Locked]
    public Ticket $ticket;

    public string $comment = '';

    public function mount(): void
    {
        abort_if($this->ticket->workspace_id !== $this->currentWorkspace->id, 404);
    }

    public function comment(): void
    {
        $this->validate([
            'comment' => ['required', 'string'],
        ]);

        // todo: create comment model for ticket
    }

    public function render(): View
    {
        return view('livewire.workspace.tickets.show-ticket')
            ->layout('components.layouts.workspace');
    }
}
