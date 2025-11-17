<?php

declare(strict_types=1);

namespace App\Managers;

final class ToastManager
{
    public function send(string $text, ?string $heading = null, ?string $icon = null, ?string $variant = null): void
    {
        $params = [
            'text' => $text,
            'heading' => $heading,
            'icon' => $icon,
            'variant' => $variant,
        ];

        app('livewire')->current()->dispatch('show-toast-message', ...$params);
    }

    public function success(string $text, ?string $heading = null): void
    {
        $this->send($text, $heading, 'check-circle', 'success');
    }

    public function warning(string $text, ?string $heading = null): void
    {
        $this->send($text, $heading, 'exclamation-circle', 'warning');
    }

    public function danger(string $text, ?string $heading = null): void
    {
        $this->send($text, $heading, 'exclamation-triangle', 'danger');
    }
}
