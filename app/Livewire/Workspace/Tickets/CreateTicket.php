<?php

declare(strict_types=1);

namespace App\Livewire\Workspace\Tickets;

use App\Models\Ticket;
use App\Models\User;
use App\Models\Workspace;
use App\Notifications\NewTicketCreated;
use Illuminate\Support\Facades\Notification;
use Illuminate\View\View;
use Livewire\Attributes\Locked;
use Livewire\Component;

final class CreateTicket extends Component
{
    #[Locked]
    public Workspace $workspace;

    public string $subject = '';

    public string $name = '';

    public string $email = '';

    public string $phone = '';

    public ?string $description = '';

    public function mount(): void
    {
        $user = current_user();

        if ($user instanceof User) {
            $this->fill($user);
        }
    }

    public function save(): void
    {
        $this->validate([
            'subject' => ['required', 'string', 'min:3', 'max:255'],
            'name' => ['required', 'string', 'min:3', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255'],
            'phone' => ['required', 'string', 'min:9', 'max:15'],
            'description' => ['nullable', 'string', 'min:3'],
        ]);

        $ticket = Ticket::query()->create([
            'subject' => $this->subject,
            'description' => $this->description,
            'workspace_id' => $this->workspace->id,
            'requester_name' => $this->name,
            'requester_email' => $this->email,
            'requester_phone' => $this->phone,
            'requester_ip_address' => request()->ip(),
        ]);

        Notification::send($this->workspace->admins, new NewTicketCreated($ticket));

        $this->reset('subject', 'name', 'email', 'phone', 'description');

        $this->redirectRoute('workspace.ticket.show', ['workspace' => $this->workspace->slug, 'ticket' => $ticket]);
    }

    public function render(): View
    {
        return view('livewire.workspace.tickets.create-ticket');
    }
}
