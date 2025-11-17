<?php

declare(strict_types=1);

namespace App\Livewire\Dashboard\Users;

use App\Enums\UserRole;
use App\Facades\Toast;
use App\Models\User;
use Flux\Flux;
use Illuminate\Validation\Rule;
use Illuminate\View\View;
use Livewire\Attributes\Locked;
use Livewire\Attributes\On;
use Livewire\Component;

final class EditUser extends Component
{
    #[Locked]
    public User $user;

    public string $name = '';

    public string $email = '';

    public string $password = '';

    public string $role = UserRole::CLIENT->value;

    #[On('show-edit-user-modal')]
    public function setUser(User $user): void
    {
        $this->user = $user;

        $this->fill($user);

        $this->role = $user->currentWorkspaceRole()->value;

        Flux::modal('edit-user')->show();
    }

    public function save(): void
    {
        $this->validate([
            'name' => ['required', 'string', 'min:3', 'max:255'],
            'email' => ['required', 'string', 'email', Rule::unique('users', 'email')->ignore($this->user)],
            'role' => ['required', 'string', Rule::in(UserRole::cases())],
        ]);

        $workspace = current_workspace();

        $this->user->update([
            'name' => $this->name,
            'email' => $this->email,
        ]);

        $this->user->workspaces()->updateExistingPivot($workspace, ['role' => $this->role]);

        Flux::modal('edit-user')->close();

        Toast::success('User was updated successfully.');

        $this->dispatch('refresh-users-list');
    }

    public function render(): View
    {
        return view('livewire.dashboard.users.edit-user');
    }
}
