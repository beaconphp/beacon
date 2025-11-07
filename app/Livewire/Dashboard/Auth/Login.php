<?php

declare(strict_types=1);

namespace App\Livewire\Dashboard\Auth;

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
            $this->addError('email', '');

            return;
        }

        $this->redirectRoute('dashboard.tickets.index', navigate: true);
    }

    public function render(): View
    {
        return view('livewire.dashboard.auth.login')
            ->layout('components.layouts.auth', ['title' => 'Login', 'heading' => 'Welcome back']);
    }
}
