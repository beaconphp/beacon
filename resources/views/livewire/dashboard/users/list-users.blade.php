<div class="space-y-6">
    <div class="flex items-center justify-between">
        <flux:heading level="1" size="xl">Users</flux:heading>
        <div class="flex items-center gap-2">
            <flux:button @click="$dispatch('show-create-user-modal')" variant="primary" icon:leading="plus" class="cursor-pointer">New user</flux:button>
            <flux:button @click="$dispatch('show-invite-user-modal')" class="cursor-pointer">Invite user</flux:button>
        </div>
    </div>
    <div class="py-5 flex items-center space-x-3 border-y border-zinc-200 dark:border-zinc-700">
        <flux:input wire:model.live.debounce350ms="search" icon="magnifying-glass" placeholder="Search in users" class="max-w-sm"/>
    </div>
    <div class="">
        <div class="flex items-center border-b border-zinc-200 dark:border-zinc-700">
            <div class="md:w-1/4 py-3 px-3 first:ps-0 last:pe-0 text-start text-sm font-medium text-zinc-800 dark:text-white">E-mail</div>
            <div class="md:w-1/4 py-3 px-3 first:ps-0 last:pe-0 text-start text-sm font-medium text-zinc-800 dark:text-white">Name</div>
            <div class="md:w-1/4 py-3 px-3 first:ps-0 last:pe-0 text-start text-sm font-medium text-zinc-800 dark:text-white">Role</div>
            <div class="md:w-10 md:ms-auto py-3 px-3 first:ps-0 last:pe-0 text-end text-sm font-medium text-zinc-800 dark:text-white"></div>
        </div>
        @forelse($users as $user)
            <x-dashboard.user.item :user="$user"/>
        @empty
            <div class="p-10 text-center">
                <div class="text-zinc-400">You have no users in this workspace</div>
            </div>
        @endforelse
        {{ $users->links('pagination.livewire') }}
    </div>

    <livewire:dashboard.users.create-user/>
    <livewire:dashboard.users.edit-user/>
    <livewire:dashboard.users.invite-user/>
</div>
