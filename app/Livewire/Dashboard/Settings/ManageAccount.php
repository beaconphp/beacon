<?php

declare(strict_types=1);

namespace App\Livewire\Dashboard\Settings;

use App\Facades\Toast;
use Illuminate\View\View;
use Livewire\Component;

final class ManageAccount extends Component
{
    public string $current_password = '';

    public string $password = '';

    public string $password_confirmation = '';

    public function updatePassword(): void
    {
        $validated = $this->validate([
            'current_password' => ['required', 'string', 'current_password'],
            'password' => ['required', 'string', 'confirmed'],
        ]);

        auth()->user()->update([
            'password' => $validated['password'],
        ]);

        Toast::success('Password was changed successfully.');

        $this->reset('current_password', 'password', 'password_confirmation');
    }

    public function render(): View
    {
        return view('livewire.dashboard.settings.manage-account')
            ->layout('components.layouts.dashboard', ['title' => 'Settings']);
    }
}
