<?php

declare(strict_types=1);

namespace App\Livewire\Dashboard\Users;

use App\Enums\UserRole;
use App\Facades\Toast;
use App\Mail\UserCreatedInWorkspace;
use App\Models\User;
use Flux\Flux;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\Rule;
use Illuminate\View\View;
use Livewire\Attributes\On;
use Livewire\Component;

final class CreateUser extends Component
{
    public string $name = '';

    public string $email = '';

    public string $password = '';

    public string $role = UserRole::CLIENT->value;

    #[On('show-create-user-modal')]
    public function openModal(): void
    {
        $this->reset();

        $this->resetErrorBag();

        Flux::modal('create-user')->show();
    }

    public function save(): void
    {
        $this->validate([
            'name' => ['required', 'string', 'min:3', 'max:255'],
            'email' => ['required', 'string', 'email', 'unique:users,email'],
            'password' => ['required', 'string', 'min:8'],
            'role' => ['required', 'string', Rule::in(UserRole::cases())],
        ]);

        $workspace = current_workspace();

        $user = User::query()->create([
            'name' => $this->name,
            'email' => $this->email,
            'password' => Hash::make($this->password),
            'current_workspace_id' => $workspace->id,
        ]);

        $user->workspaces()->attach($workspace, ['role' => $this->role]);

        $user->save();

        Mail::to($this->email)->send(new UserCreatedInWorkspace($workspace, $this->email, $this->password));

        Toast::success("User {$user->name} was successfully created.");

        Flux::modal('create-user')->close();

        $this->dispatch('refresh-users-list');
    }

    public function render(): View
    {
        return view('livewire.dashboard.users.create-user');
    }
}
