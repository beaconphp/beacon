<div class="space-y-6">
    <div class="flex items-center justify-between">
        <flux:heading level="1" size="xl">Tickets</flux:heading>
        <flux:button @click="$dispatch('show-create-ticket-modal')" variant="primary" icon:leading="plus" class="cursor-pointer">New ticket</flux:button>
    </div>
    <div class="py-5 flex items-center space-x-3 border-y border-zinc-200 dark:border-zinc-700">
        <flux:dropdown>
            <flux:button variant="{{ $status !== 'all' ? 'primary' : 'outline' }}" icon:leading="tag" icon:trailing="chevron-down" size="sm" class="cursor-pointer">
                {{ $status === 'all' ? 'Status' : \App\Enums\TicketStatus::tryFrom($status)?->label() }}
            </flux:button>

            <flux:menu>
                <flux:menu.radio.group wire:model.live.debounce250ms="status">
                    <flux:menu.radio value="all" class="cursor-pointer">All</flux:menu.radio>
                    @foreach(\App\Enums\TicketStatus::cases() as $s)
                        <flux:menu.radio value="{{ $s->value }}" class="cursor-pointer">{{ $s->label() }}</flux:menu.radio>
                    @endforeach
                </flux:menu.radio.group>
            </flux:menu>
        </flux:dropdown>

        <flux:dropdown>
            <flux:button variant="{{ $priority !== 'all' ? 'primary' : 'outline' }}" icon:leading="exclamation-triangle" icon:trailing="chevron-down" size="sm" class="cursor-pointer">
                {{ $priority === 'all' ? 'Priority' : \App\Enums\TicketPriority::tryFrom($priority)?->label() }}
            </flux:button>

            <flux:menu>
                <flux:menu.radio.group wire:model.live.debounce250ms="priority">
                    <flux:menu.radio value="all" class="cursor-pointer">All</flux:menu.radio>
                    @foreach(\App\Enums\TicketPriority::cases() as $p)
                        <flux:menu.radio value="{{ $p->value }}" class="cursor-pointer">{{ $p->label() }}</flux:menu.radio>
                    @endforeach
                </flux:menu.radio.group>
            </flux:menu>
        </flux:dropdown>

        <flux:dropdown>
            <flux:button variant="{{ $assigned_to !== 'anyone' ? 'primary' : 'outline' }}" icon:leading="user" icon:trailing="chevron-down" size="sm" class="cursor-pointer">
                {{ $assigned_to === 'anyone' ? 'Assigned to' : \App\Models\User::query()->find($assigned_to)?->name }}
            </flux:button>

            <flux:menu>
                <flux:menu.radio.group wire:model.live.debounce250ms="assigned_to">
                    <flux:menu.radio value="anyone" class="cursor-pointer">Anyone</flux:menu.radio>
                    @foreach(current_workspace()?->users as $u)
                        <flux:menu.radio value="{{ $u->id }}" class="cursor-pointer">{{ $u->name }}</flux:menu.radio>
                    @endforeach
                </flux:menu.radio.group>
            </flux:menu>
        </flux:dropdown>
    </div>
    <div class="">
        <div class="flex items-center border-b border-zinc-200 dark:border-zinc-700">
            <div class="md:w-1/5 py-3 px-3 first:ps-0 last:pe-0 text-start text-sm font-medium text-zinc-800 dark:text-white">Requester</div>
            <div class="md:w-1/3 py-3 px-3 first:ps-0 last:pe-0 text-start text-sm font-medium text-zinc-800 dark:text-white">Subject</div>
            <div class="md:w-1/4 py-3 px-3 first:ps-0 last:pe-0 text-start text-sm font-medium text-zinc-800 dark:text-white">Status</div>
            <div class="md:w-1/4 py-3 px-3 first:ps-0 last:pe-0 text-start text-sm font-medium text-zinc-800 dark:text-white">Created</div>
            <div class="md:w-10 py-3 px-3 first:ps-0 last:pe-0 text-end text-sm font-medium text-zinc-800 dark:text-white"></div>
        </div>
        @forelse($tickets as $ticket)
            <x-dashboard.ticket.item :ticket="$ticket"/>
        @empty
            <div class="p-10 text-center">
                <div class="text-zinc-400">You have no tickets in this workspace</div>
            </div>
        @endforelse
    </div>

    <livewire:dashboard.tickets.view-ticket/>
    <livewire:dashboard.tickets.create-ticket/>
</div>
