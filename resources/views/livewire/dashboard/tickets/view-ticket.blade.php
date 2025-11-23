<flux:modal name="view-ticket" variant="flyout" class="w-full md:w-1/2 md:min-w-[300px] xl:max-w-[800px]">
    @if($ticket)
        <div class="space-y-6">
            <flux:heading size="lg">{{ $ticket->subject }}</flux:heading>
            <div class="flex flex-col gap-2">
                <div class="flex items-center h-10 gap-5 border-b border-zinc-200 dark:border-zinc-700">
                    <flux:label class="md:w-[120px]">Status</flux:label>
                    <div class="flex-1" wire:key="ticket-{{$ticket->id}}-status-{{ $ticket->status }}">
                        <flux:dropdown>
                            <button>
                                <flux:badge size="sm" :color="$ticket->status->color()" class="cursor-pointer">{{ $ticket->status->label() }}</flux:badge>
                            </button>

                            <flux:menu>
                                <flux:menu.radio.group wire:model.live.debounce250ms="status">
                                    @foreach(\App\Enums\TicketStatus::cases() as $s)
                                        <flux:menu.radio value="{{ $s->value }}">{{ $s->label() }}</flux:menu.radio>
                                    @endforeach
                                </flux:menu.radio.group>
                            </flux:menu>
                        </flux:dropdown>
                    </div>
                </div>
                <div class="flex items-center h-10 gap-5 border-b border-zinc-200 dark:border-zinc-700">
                    <flux:label class="md:w-[120px]">Priority</flux:label>
                    <div class="flex-1">
                        <flux:dropdown>
                            <button class="cursor-pointer flex items-center gap-2">
                                <flux:icon.exclamation-triangle variant="solid" @class([
                                    'size-5',
                                    'text-zinc-500' => $ticket->priority === \App\Enums\TicketPriority::NORMAL,
                                    'text-lime-500' => $ticket->priority === \App\Enums\TicketPriority::LOW,
                                    'text-yellow-500' => $ticket->priority === \App\Enums\TicketPriority::MEDIUM,
                                    'text-rose-400' => $ticket->priority === \App\Enums\TicketPriority::HIGH,
                                    'text-red-500' => $ticket->priority === \App\Enums\TicketPriority::CRITICAL,
                                ])/>
                                <span class="text-sm mb-0.5">{{ $ticket->priority->label() }}</span>
                            </button>

                            <flux:menu>
                                <flux:menu.radio.group wire:model.live.debounce250ms="priority">
                                    @foreach(\App\Enums\TicketPriority::cases() as $p)
                                        <flux:menu.radio value="{{ $p->value }}">{{ $p->label() }}</flux:menu.radio>
                                    @endforeach
                                </flux:menu.radio.group>
                            </flux:menu>
                        </flux:dropdown>
                    </div>
                </div>
                <div class="flex items-center h-10 gap-5 border-b border-zinc-200 dark:border-zinc-700">
                    <flux:label class="md:w-[120px]">Assignee</flux:label>
                    <div class="flex-1" wire:key="ticket-{{$ticket->id}}-assignee-{{ $ticket->assigned_to }}">
                        <flux:dropdown>
                            <button class="cursor-pointer flex items-center gap-2">
                                @if($ticket->assignee)
                                    <flux:avatar :name="$ticket->assignee->name" size="xs" circle/>
                                    <span class="text-sm">{{ $ticket->assignee->name }}</span>
                                @else
                                    <span class="text-xs italic text-zinc-400">none</span>
                                @endif
                            </button>

                            <flux:menu>
                                @foreach(current_workspace()->users as $u)
                                    <flux:menu.item wire:click="assignUser({{ $u->id }})" class="cursor-pointer" :icon="$ticket->assignee?->id === $u->id ? 'check' : ''" data-flux-menu-item-has-icon>{{ $u->name }}</flux:menu.item>
                                @endforeach
                            </flux:menu>
                        </flux:dropdown>
                    </div>
                </div>
            </div>
            <div class="group" x-data="{ edit: false }" @click.outside="edit = false" x-on:hide-description-edit.window="edit = false">
                <div class="flex items-center mb-2">
                    <flux:label>Ticket description</flux:label>
                    @if($ticket->description)
                        <flux:dropdown class="ms-auto">
                            <flux:button icon="ellipsis-horizontal" size="xs" class="cursor-pointer"/>

                            <flux:menu>
                                <flux:menu.item @click="edit = true; $nextTick(() => $refs.descriptionInput.focus())" icon="pencil" class="cursor-pointer" x-show="!edit">Edit description</flux:menu.item>
                                <flux:menu.item @click="edit = false" icon="pencil" class="cursor-pointer" x-show="edit">Cancel editing</flux:menu.item>
                                <flux:menu.item wire:click="deleteDescription" variant="danger" icon="trash" class="cursor-pointer">Delete description</flux:menu.item>
                            </flux:menu>
                        </flux:dropdown>
                    @endif
                </div>
                @if($ticket->description)
                    <flux:text size="lg" x-show="!edit">{!! html_entity_decode($ticket->description) !!}</flux:text>
                @else
                    <flux:button @click="edit = true; $nextTick(() => $refs.descriptionInput.focus())" class="cursor-pointer" x-show="!edit">Add ticket description</flux:button>
                @endif

                <div class="space-y-3" x-show="edit">
                    <flux:textarea x-ref="descriptionInput" rows="6" wire:model="description"/>
                    <flux:button.group>
                        <flux:button wire:click="updateDescription" variant="primary" size="sm" class="cursor-pointer">Save</flux:button>
                        <flux:button @click="edit = false" size="sm" class="cursor-pointer">Cancel</flux:button>
                    </flux:button.group>
                </div>
            </div>
        </div>
    @endif
</flux:modal>