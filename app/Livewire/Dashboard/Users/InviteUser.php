<?php

declare(strict_types=1);

namespace App\Livewire\Dashboard\Users;

use App\Facades\Toast;
use App\Models\User;
use Flux\Flux;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\View\View;
use Livewire\Attributes\On;
use Livewire\Attributes\Url;
use Livewire\Component;

final class InviteUser extends Component
{
    #[Url(as: 'iq')]
    public string $search = '';

    public array $selected = [];

    #[On('show-invite-user-modal')]
    public function openModal(): void
    {
        $this->reset('search', 'selected');

        $this->resetErrorBag();

        Flux::modal('invite-user')->show();
    }

    public function invite(): void
    {
        $users = User::query()
            ->whereIn('id', $this->selected)
            ->get();

        $workspace = current_workspace();

        foreach ($users as $user) {
            if ($user->belongsToWorkspace($workspace)) {
                continue;
            }

            Toast::success("User {$user->name} was successfully added to this workspace.");

            $user->workspaces()->attach($workspace);

            $user->save();
        }

        Flux::modal('invite-user')->close();

        $this->dispatch('refresh-users-list');
    }

    public function render(): View
    {
        $users = User::query()
            ->whereDoesntHave('workspaces', function (Builder $query): void {
                $query->where('workspace_id', current_workspace()->id);
            })
            ->when($this->search, function (Builder $query, string $search): void {
                $query->where(function (Builder $query) use ($search): void {
                    $query->whereLike('name', "%{$search}%")
                        ->orWhereLike('email', "%{$search}%");
                });
            })
            ->get();

        return view('livewire.dashboard.users.invite-user', [
            'users' => $users,
        ]);
    }
}
