@props([
	'user'
])

<div wire:key="user-item-{{ $user->id }}">
    <div class="flex items-center border-b border-zinc-200 dark:border-zinc-700">
        <div class="md:w-1/4 py-3 px-3 first:ps-0 last:pe-0 text-start text-sm font-medium text-zinc-800 dark:text-white">{{ $user->email }}</div>
        <div class="md:w-1/4 py-3 px-3 first:ps-0 last:pe-0 text-start text-sm font-medium text-zinc-800 dark:text-white">{{ $user->name }}</div>
        <div class="md:w-1/4 py-3 px-3 first:ps-0 last:pe-0 text-start text-sm font-medium text-zinc-800 dark:text-white">{{ $user->membership->role }}</div>
        <div class="md:w-10 md:ms-auto py-3 px-3 first:ps-0 last:pe-0 text-end text-sm font-medium text-zinc-800 dark:text-white">
            <flux:dropdown>
                <flux:button icon="ellipsis-horizontal" size="xs" class="cursor-pointer"/>

                <flux:menu>
                    <flux:menu.item wire:click="edit({{ $user->id }})" icon="pencil" class="cursor-pointer">Edit user</flux:menu.item>
                    <flux:menu.item wire:click="remove({{ $user->id }})" variant="danger" icon="x-circle" class="cursor-pointer">Remove from workspace</flux:menu.item>
                    <flux:modal.trigger name="delete-user-{{ $user->id }}">
                        <flux:menu.item variant="danger" icon="trash" class="cursor-pointer">Delete user</flux:menu.item>
                    </flux:modal.trigger>
                </flux:menu>
            </flux:dropdown>
        </div>
    </div>

    <flux:modal name="delete-user-{{ $user->id }}" class="w-[22rem]">
        <div class="space-y-6">
            <div>
                <flux:heading size="lg">Delete user?</flux:heading>

                <flux:text class="mt-2">You're about to delete this user. This action cannot be reversed.</flux:text>
            </div>

            <div class="flex gap-2">
                <flux:spacer />

                <flux:modal.close>
                    <flux:button variant="ghost" class="cursor-pointer">Cancel</flux:button>
                </flux:modal.close>

                <flux:button wire:click="delete({{ $user->id }})" variant="danger" class="cursor-pointer">Delete user</flux:button>
            </div>
        </div>
    </flux:modal>
</div>