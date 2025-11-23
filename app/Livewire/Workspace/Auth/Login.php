<?php

declare(strict_types=1);

namespace App\Livewire\Workspace\Auth;

use App\Livewire\Workspace\WorkspaceComponent;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;
use Livewire\Attributes\Validate;

final class Login extends WorkspaceComponent
{
    #[Validate('required|string|email')]
    public string $email = '';

    #[Validate('required|string')]
    public string $password = '';

    public bool $remember = false;

    public function authenticate(): void
    {
        $this->validate();

        $user = User::query()->where('email', $this->email)->first();

        if (! $user || ! Hash::check($this->password, $user->password)) {
            $this->addError('email', 'The email or password you entered is incorrect.');

            return;
        }

        if (! $user->belongsToWorkspace($this->currentWorkspace)) {
            $this->addError('email', 'This account does not belong to this workspace.');

            return;
        }

        auth()->login($user, $this->remember);

        $this->redirectRoute('workspace.show', [
            'workspace' => $this->workspace,
        ]);
    }

    public function render(): View
    {
        return view('livewire.workspace.auth.login')
            ->layout('components.layouts.workspace', ['title' => 'Login']);
    }
}
