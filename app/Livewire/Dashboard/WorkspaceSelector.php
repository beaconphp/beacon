<?php

declare(strict_types=1);

namespace App\Livewire\Dashboard;

use App\Models\User;
use App\Models\Workspace;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\View\View;
use Livewire\Attributes\Locked;
use Livewire\Component;

final class WorkspaceSelector extends Component
{
    #[Locked]
    public User $user;

    public int $workspace_id;

    public Collection $workspaces;

    public function mount(): void
    {
        $this->user = current_user();
        $this->workspace_id = $this->user->current_workspace_id;
        $this->workspaces = $this->user->workspaces;
    }

    public function updatedWorkspaceId(int $value): void
    {
        $workspace = Workspace::query()->find($value);

        if (! $workspace) {
            return;
        }

        if (! $this->user->belongsToWorkspace($workspace)) {
            return;
        }

        $this->user->update([
            'current_workspace_id' => $value,
        ]);

        $this->dispatch('refresh-ticket-list');
    }

    public function render(): View
    {
        return view('livewire.dashboard.workspace-selector');
    }
}
