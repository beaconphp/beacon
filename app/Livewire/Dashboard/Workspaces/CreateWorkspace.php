<?php

declare(strict_types=1);

namespace App\Livewire\Dashboard\Workspaces;

use App\Enums\UserRole;
use App\Models\Workspace;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Illuminate\View\View;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;
use Livewire\WithFileUploads;

final class CreateWorkspace extends Component
{
    use WithFileUploads;

    #[Validate('required|string|min:3|max:255')]
    public string $name = '';

    #[Validate('nullable|image|max:10240')]
    public ?TemporaryUploadedFile $avatar = null;

    public function save(): void
    {
        $this->validate();

        $user = current_user();

        $workspace = Workspace::query()->create([
            'name' => $this->name,
            'slug' => Str::slug(Arr::join([$this->name, uniqid()], '-')),
            'author_id' => $user->id,
        ]);

        $user->workspaces()->attach($workspace->id, ['role' => UserRole::OWNER->value]);

        $user->update([
            'current_workspace_id' => $workspace->id,
        ]);

        $this->redirectRoute('dashboard.tickets.index', navigate: true);
    }

    public function render(): View
    {
        return view('livewire.dashboard.workspace.create-workspace')
            ->layout('components.layouts.auth', ['title' => 'New workspace', 'logo' => false, 'heading' => 'New workspace']);
    }
}
