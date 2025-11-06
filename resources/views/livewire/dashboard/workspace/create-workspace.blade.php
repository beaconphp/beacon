<div>
    <flux:subheading class="text-center mb-6">Workspace is a place where you can organize your tickets</flux:subheading>

    <form wire:submit="save" class="flex flex-col gap-6">
        <flux:input label="Name" wire:model.live.debounce350ms="name" placeholder="Enter workspace name"/>

        <flux:button type="submit" variant="primary" class="w-full cursor-pointer">Create</flux:button>
    </form>
</div>
