<?php

declare(strict_types=1);

namespace App\Livewire\Dashboard\Tickets;

use App\Enums\TicketPriority;
use App\Enums\TicketStatus;
use App\Facades\Toast;
use App\Models\Ticket;
use App\Models\User;
use Flux\Flux;
use Illuminate\Validation\Rule;
use Illuminate\View\View;
use Livewire\Attributes\On;
use Livewire\Component;

final class CreateTicket extends Component
{
    public string $subject = '';

    public string $status = TicketStatus::OPEN->value;

    public string $priority = TicketPriority::NORMAL->value;

    public int|string $assigned_to = '';

    public ?string $description = '';

    #[On('show-create-ticket-modal')]
    public function openModal(): void
    {
        $this->reset();

        $this->resetErrorBag();

        Flux::modal('create-ticket')->show();
    }

    public function save(): void
    {
        $this->validate([
            'subject' => ['required', 'string', 'min:3', 'max:255'],
            'status' => ['required', 'string', Rule::in(TicketStatus::cases())],
            'priority' => ['required', 'string', Rule::in(TicketPriority::cases())],
            'assigned_to' => ['nullable', 'integer', 'exists:users,id'],
            'description' => ['nullable', 'string', 'min:3'],
        ]);

        $workspace = current_workspace();

        if (is_int($this->assigned_to)) {
            $assignee = User::query()->find($this->assigned_to);

            if (! $assignee->belongsToWorkspace($workspace)) {
                $this->addError('assigned_to', 'Assigned user does not belong to workspace');

                return;
            }
        }

        Ticket::query()->create([
            'subject' => $this->subject,
            'status' => $this->status,
            'priority' => $this->priority,
            'assigned_to' => is_int($this->assigned_to) ? $this->assigned_to : null,
            'description' => $this->description,
            'workspace_id' => $workspace->id,
        ]);

        Toast::success('New ticket was successfully created.');

        Flux::modal('create-ticket')->close();

        $this->dispatch('refresh-ticket-list');
    }

    public function render(): View
    {
        return view('livewire.dashboard.tickets.create-ticket');
    }
}
