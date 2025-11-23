<?php

declare(strict_types=1);

namespace App\Livewire\Workspace\Auth;

use Illuminate\View\View;
use Livewire\Attributes\Validate;
use Livewire\Component;

final class Login extends Component
{
    #[Validate('required|string|email')]
    public string $email = '';

    #[Validate('required|string')]
    public string $password = '';

    public bool $remember = false;

    public function authenticate(): void
    {
        $this->validate();

        if (! auth()->attempt(['email' => $this->email, 'password' => $this->password], $this->remember)) {
            $this->addError('email', 'The email or password you entered is incorrect.');

            return;
        }

        $workspace = request()->route('workspace');

        $user = current_user();

        if (! $user->belongsToWorkspace($workspace)) {
            $this->addError('email', 'This account does not belong to this workspace.');

            return;
        }

        $this->redirectRoute('workspace.show', [
            'workspace' => $workspace,
        ]);
    }

    public function render(): View
    {
        return view('livewire.workspace.auth.login')
            ->layout('components.layouts.workspace', ['title' => 'Login']);
    }
}
