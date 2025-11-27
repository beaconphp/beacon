<?php

declare(strict_types=1);

namespace App\Livewire\Dashboard\Settings;

use App\Facades\Toast;
use App\Models\Workspace;
use Illuminate\Validation\Rule;
use Illuminate\View\View;
use Livewire\Attributes\Locked;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;
use Livewire\WithFileUploads;

final class ManageWorkspace extends Component
{
    use WithFileUploads;

    #[Locked]
    public Workspace $workspace;

    public string $name = '';

    public string $slug = '';

    public ?TemporaryUploadedFile $avatar = null;

    public bool $is_guarded = false;

    public string $delete_workspace_name = '';

    #[On('workspace-changed')]
    public function mount(): void
    {
        $this->workspace = current_workspace();

        $this->fill([
            'name' => $this->workspace->name,
            'slug' => $this->workspace->slug,
            'is_guarded' => $this->workspace->is_guarded,
        ]);
    }

    public function update(): void
    {
        $this->validate([
            'name' => ['required', 'string', 'min:3', 'max:255'],
            'slug' => ['required', 'string', 'min:3', Rule::unique('workspaces', 'slug')->ignore($this->workspace)],
            'avatar' => ['nullable', 'image', 'max:1024'],
            'is_guarded' => ['boolean'],
        ]);

        $avatar = $this->workspace->avatar;

        if ($this->avatar instanceof TemporaryUploadedFile) {
            $avatar = $this->avatar->storePublicly('workspaces/avatar', 'public');
        }

        $this->workspace->update([
            'name' => $this->name,
            'slug' => $this->slug,
            'avatar' => $avatar,
            'is_guarded' => $this->is_guarded,
        ]);

        Toast::success('Workspace was updated successfully.');

        $this->redirectRoute('dashboard.settings.workspace', navigate: true);
    }

    public function delete(): void
    {
        $this->validate([
            'delete_workspace_name' => ['required', 'string', 'min:3', 'max:255'],
        ]);

        if ($this->delete_workspace_name !== $this->workspace->name) {
            $this->addError('delete_workspace_name', 'Workspace name do not match.');

            return;
        }

        $this->workspace->delete();

        current_user()->update([
            'current_workspace_id' => current_user()->adminWorkspaces->first()?->id,
        ]);

        $this->redirectRoute('dashboard.tickets.index');
    }

    public function render(): View
    {
        return view('livewire.dashboard.settings.manage-workspace')
            ->layout('components.layouts.dashboard', ['title' => 'Settings']);
    }
}
