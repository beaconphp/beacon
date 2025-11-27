@props([
	'ticket'
])

<div wire:key="ticket-item-{{ $ticket->id }}">
    <div class="flex items-center border-b border-zinc-200 dark:border-zinc-700 hover:bg-zinc-100 dark:hover:bg-zinc-800" ondblclick="@this.call('view', '{{ $ticket->id }}')">
        <div class="md:w-1/5 py-3 px-3 first:ps-0 last:pe-0 text-start text-sm font-medium text-zinc-800 dark:text-white">
            <div class="flex items-center gap-2">
                @if($ticket->requester)
                    <flux:avatar :name="$ticket->requester->name" size="sm" circle/>
                    <div>
                        <div class="mb-0.5">{{ $ticket->requester->name }}</div>
                        <div class="text-zinc-400 text-xs font-normal">{{ $ticket->requester->email }}</div>
                    </div>
                @else
                    <flux:avatar :name="$ticket->requester_name" size="sm" circle/>
                    <div>
                        <div class="mb-0.5">{{ $ticket->requester_name }}</div>
                        <div class="text-zinc-400 text-xs font-normal">{{ $ticket->requester_email }}</div>
                    </div>
                @endif
            </div>
        </div>
        <div class="md:w-1/3 py-3 px-3 first:ps-0 last:pe-0 text-start font-medium text-zinc-800 dark:text-white">
            <div class="flex items-center gap-2">
                <flux:tooltip content="Priority: {{ $ticket->priority->label() }}">
                    <flux:icon.exclamation-triangle variant="solid" @class([
                        'size-5',
                        'text-zinc-500' => $ticket->priority === \App\Enums\TicketPriority::NORMAL,
                        'text-lime-500' => $ticket->priority === \App\Enums\TicketPriority::LOW,
                        'text-yellow-500' => $ticket->priority === \App\Enums\TicketPriority::MEDIUM,
                        'text-rose-400' => $ticket->priority === \App\Enums\TicketPriority::HIGH,
                        'text-red-500' => $ticket->priority === \App\Enums\TicketPriority::CRITICAL,
                    ])/>
                </flux:tooltip>
                <span class="mb-0.5">{{ $ticket->subject }}</span>
            </div>
        </div>
        <div class="md:w-1/4 py-3 px-3 first:ps-0 last:pe-0 text-start text-sm font-medium text-zinc-800 dark:text-white">
            <flux:badge size="sm" :color="$ticket->status->color()">{{ $ticket->status->label() }}</flux:badge>
        </div>
        <div class="md:w-24 py-3 px-3 first:ps-0 last:pe-0 text-start text-sm font-medium text-zinc-800 dark:text-white">
            <div class="flex items-center gap-2">
                @if($ticket->assignee)
                    <flux:tooltip :content="$ticket->assignee->name">
                        <flux:avatar :name="$ticket->assignee->name" size="sm" circle/>
                    </flux:tooltip>
                @endif
            </div>
        </div>
        <div class="md:w-1/4 py-3 px-3 first:ps-0 last:pe-0 text-end text-sm text-zinc-400">
            {{ $ticket->created_at->diffForHumans() }}
        </div>
        <div class="md:w-10 py-3 px-3 first:ps-0 last:pe-0 text-end text-sm font-medium text-zinc-800 dark:text-white">
            <flux:dropdown>
                <flux:button icon="ellipsis-horizontal" size="xs" class="cursor-pointer"/>

                <flux:menu>
                    <flux:menu.item wire:click="view('{{ $ticket->id }}')" icon="eye" class="cursor-pointer">View ticket</flux:menu.item>
                    <flux:modal.trigger name="delete-ticket-{{ $ticket->id }}">
                        <flux:menu.item variant="danger" icon="trash" class="cursor-pointer">Delete ticket</flux:menu.item>
                    </flux:modal.trigger>
                </flux:menu>
            </flux:dropdown>
        </div>
    </div>

    <flux:modal name="delete-ticket-{{ $ticket->id }}" class="w-[22rem]">
        <div class="space-y-6">
            <div>
                <flux:heading size="lg">Delete ticket?</flux:heading>

                <flux:text class="mt-2">You're about to delete this ticket. This action cannot be reversed.</flux:text>
            </div>

            <div class="flex gap-2">
                <flux:spacer />

                <flux:modal.close>
                    <flux:button variant="ghost" class="cursor-pointer">Cancel</flux:button>
                </flux:modal.close>

                <flux:button wire:click="delete('{{ $ticket->id }}')" variant="danger" class="cursor-pointer">Delete ticket</flux:button>
            </div>
        </div>
    </flux:modal>
</div>
