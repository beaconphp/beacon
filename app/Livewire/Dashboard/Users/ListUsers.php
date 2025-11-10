<?php

declare(strict_types=1);

namespace App\Livewire\Dashboard\Users;

use App\Models\User;
use Flux\Flux;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\View\View;
use Livewire\Attributes\On;
use Livewire\Attributes\Url;
use Livewire\Component;

final class ListUsers extends Component
{
    #[Url(as: 'q')]
    public string $search = '';

    public function remove(int $id): void
    {
        $user = User::query()->find($id);

        if (! $user) {
            return;
        }

        if ($user->id === auth()->id()) {
            return;
        }

        $user->workspaces()->detach(current_workspace());

        $user->save();
    }

    public function delete(int $id): void
    {
        $user = User::query()->find($id);

        if (! $user) {
            Flux::modal("delete-user-{$id}")->close();

            return;
        }

        if ($user->id === auth()->id()) {
            Flux::modal("delete-user-{$user->id}")->close();

            return;
        }

        $user->delete();
    }

    #[On('refresh-users-list')]
    #[On('workspace-changed')]
    public function render(): View
    {
        $users = current_workspace()
            ->users()
            ->latest()
            ->when($this->search, function (Builder $query, string $search): void {
                $query->where(function (Builder $query) use ($search): void {
                    $query->whereLike('name', "%{$search}%")
                        ->orWhereLike('email', "%{$search}%");
                });
            });

        $users = $users->paginate(24);

        return view('livewire.dashboard.users.list-users', [
            'users' => $users,
        ])
            ->layout('components.layouts.dashboard', ['title' => 'Users']);

    }
}
