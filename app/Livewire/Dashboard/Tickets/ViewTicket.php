<?php

declare(strict_types=1);

namespace App\Livewire\Dashboard\Tickets;

use App\Models\Ticket;
use App\Models\User;
use Flux\Flux;
use Illuminate\View\View;
use Livewire\Attributes\Locked;
use Livewire\Attributes\On;
use Livewire\Component;

final class ViewTicket extends Component
{
    #[Locked]
    public Ticket $ticket;

    public string $subject = '';

    public string $status = '';

    public string $priority = '';

    public null|int|string $assigned_to = null;

    public ?string $description = '';

    #[On('show-view-ticket-modal')]
    public function setTicket(Ticket $ticket): void
    {
        $this->ticket = $ticket;

        $this->fill($ticket);

        Flux::modal('view-ticket')->show();
    }

    public function updatedStatus(string $value): void
    {
        $this->ticket->update([
            'status' => $value,
        ]);

        $this->dispatch('refresh-ticket-list');
    }

    public function updatedPriority(string $value): void
    {
        $this->ticket->update([
            'priority' => $value,
        ]);

        $this->dispatch('refresh-ticket-list');
    }

    public function assignUser(int $value): void
    {
        $assignee = User::query()->find($value);

        if (! $assignee->belongsToWorkspace(current_workspace())) {
            return;
        }

        if ($this->ticket->assignee && $assignee->id === $this->ticket->assignee->id) {
            $this->ticket->assignee()->disassociate();
        } else {
            $this->ticket->assignee()->associate($value);
        }

        $this->ticket->save();

        $this->dispatch('refresh-ticket-list');
    }

    public function updateDescription(): void
    {
        $this->ticket->update([
            'description' => $this->description,
        ]);

        $this->dispatch('hide-description-edit');
    }

    public function deleteDescription(): void
    {
        $this->ticket->update([
            'description' => null,
        ]);
    }

    public function render(): View
    {
        return view('livewire.dashboard.tickets.view-ticket');
    }
}
