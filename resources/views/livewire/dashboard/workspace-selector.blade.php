<flux:dropdown position="top" align="start" class="max-lg:hidden">
    <flux:sidebar.profile name="{{ $user->currentWorkspace?->name }}" class="cursor-pointer"/>

    <flux:menu>
        <flux:menu.radio.group wire:model.live="workspace_id">
            @foreach($user->workspaces as $workspace)
                <flux:menu.radio value="{{ $workspace->id }}">{{ $workspace->name }}</flux:menu.radio>
            @endforeach
        </flux:menu.radio.group>

        <flux:menu.separator />

        <flux:menu.item href="{{ route('dashboard.workspaces.create') }}" icon="plus">New workspace</flux:menu.item>

        <flux:menu.separator />

        <form action="{{ route('logout') }}" method="post">
            @csrf
            <flux:menu.item type="submit" icon="arrow-right-start-on-rectangle" class="cursor-pointer">Logout</flux:menu.item>
        </form>
    </flux:menu>
</flux:dropdown>