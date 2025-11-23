<flux:modal name="create-ticket">
    <div class="space-y-6">
        <flux:heading size="lg">New ticket</flux:heading>
        <form wire:submit="save">
            <div class="space-y-6">
                <flux:input label="Subject" placeholder="Enter ticket subject" wire:model="subject"/>
                <flux:radio.group wire:model="status" label="Status" variant="segmented">
                    @foreach(\App\Enums\TicketStatus::cases() as $s)
                        <flux:radio :value="$s->value" :label="$s->label()"/>
                    @endforeach
                </flux:radio.group>
                <flux:radio.group wire:model="priority" label="Priority" variant="segmented">
                    @foreach(\App\Enums\TicketPriority::cases() as $p)
                        <flux:radio :value="$p->value" :label="$p->label()"/>
                    @endforeach
                </flux:radio.group>
                <flux:select label="Assignee" wire:model="assigned_to" placeholder="Select assignee">
                    @foreach(current_workspace()->users as $u)
                        <flux:select.option :value="$u->id">{{ $u->name }}</flux:select.option>
                    @endforeach
                </flux:select>
                <flux:textarea label="Description" rows="6" placeholder="Enter ticket description" wire:model="description"/>
                <div class="flex items-center gap-3">
                    <flux:button type="submit" variant="primary" class="cursor-pointer">Create</flux:button>
                    <flux:modal.close>
                        <flux:button variant="filled" class="cursor-pointer">Cancel</flux:button>
                    </flux:modal.close>
                </div>
            </div>
        </form>
    </div>
</flux:modal>