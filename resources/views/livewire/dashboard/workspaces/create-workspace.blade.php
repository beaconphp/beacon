<div class="space-y-6">
    <flux:subheading class="text-center">Workspace is a place where you can organize your tickets</flux:subheading>

    <form wire:submit="save" class="flex flex-col gap-6">
        <flux:input label="Name" wire:model.live.debounce350ms="name" placeholder="Enter workspace name"/>

        <flux:button type="submit" variant="primary" class="w-full cursor-pointer">Create</flux:button>
    </form>

    <flux:link variant="subtle" class="text-sm inline-flex items-center gap-2" href="{{ route('dashboard.tickets.index') }}">
        <flux:icon.arrow-left class="size-4"/>
        <span>Back to dashboard</span>
    </flux:link>
</div>
