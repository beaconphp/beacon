<?php

declare(strict_types=1);

namespace App\Livewire\Workspace;

use App\Models\Workspace;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Locked;
use Livewire\Component;

abstract class WorkspaceComponent extends Component
{
    #[Locked]
    public string $workspace;

    #[Computed]
    final public function currentWorkspace(): ?Workspace
    {
        return Workspace::query()->where('slug', $this->workspace)->first();
    }
}
