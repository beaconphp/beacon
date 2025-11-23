<?php

declare(strict_types=1);

namespace App\Livewire\Dashboard\Tickets;

use App\Facades\Toast;
use App\Models\Ticket;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Builder;
use Livewire\Attributes\On;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

final class ListTickets extends Component
{
    use WithPagination;

    #[Url(except: 'all')]
    public string $status = 'all';

    #[Url(except: 'all')]
    public string $priority = 'all';

    #[Url(except: 'anyone')]
    public string|int $assigned_to = 'anyone';

    public ?Ticket $viewTicket = null;

    public function view(int $id): void
    {
        $ticket = Ticket::query()->find($id);

        if (! $ticket) {
            return;
        }

        $this->dispatch('show-view-ticket-modal', ticket: $ticket);
    }

    public function delete(int $id): void
    {
        $ticket = Ticket::query()->find($id);

        if (! $ticket) {
            return;
        }

        $ticket->delete();

        Toast::success('Ticket was successfully deleted.');
    }

    #[On('refresh-ticket-list')]
    #[On('workspace-changed')]
    public function render(): Factory|View
    {
        $tickets = Ticket::query()
            ->latest()
            ->where('workspace_id', current_workspace()->id)
            ->when($this->status && $this->status !== 'all', function (Builder $query): void {
                $query->where('status', $this->status);
            })
            ->when($this->priority && $this->priority !== 'all', function (Builder $query): void {
                $query->where('priority', $this->priority);
            })
            ->when($this->assigned_to && $this->assigned_to !== 'anyone', function (Builder $query): void {
                $query->where('assigned_to', $this->assigned_to);
            });

        $tickets = $tickets->paginate(24);

        return view('livewire.dashboard.tickets.list-tickets', [
            'tickets' => $tickets,
        ])
            ->layout('components.layouts.dashboard', ['title' => 'Tickets']);
    }
}
