<?php

declare(strict_types=1);

namespace App\Livewire;

use Illuminate\View\View;
use Livewire\Attributes\On;
use Livewire\Component;

final class Toasts extends Component
{
    public array $toasts = [];

    #[On('show-toast-message')]
    public function addToastMessage(string $text, ?string $heading = null, ?string $icon = null, ?string $variant = null): void
    {
        $this->toasts[] = [
            'text' => $text,
            'heading' => $heading,
            'icon' => $icon,
            'variant' => $variant,
        ];
    }

    public function render(): View
    {
        return view('livewire.toasts');
    }
}
