<flux:modal name="invite-user" class="md:min-w-sm">
    <div class="space-y-6">
        <div class="flex items-center justify-between">
            <flux:heading size="lg">Invite user</flux:heading>
        </div>
        <flux:input wire:model.live.debounce350ms="search" icon="magnifying-glass" placeholder="Search user" class="max-w-sm"/>
        <form wire:submit="invite" class="space-y-6">
            <div class="max-h-64 overflow-y-auto">
                @if($users->isNotEmpty())
                    <flux:checkbox.group wire:model="selected">
                        @foreach($users as $user)
                            <flux:checkbox :label="$user->name" :description="$user->email" :value="$user->id"/>
                        @endforeach
                    </flux:checkbox.group>
                @else
                    <div class="text-sm text-zinc-400">No available users to invite</div>
                @endif
            </div>

            <div class="flex items-center gap-3">
                <flux:button type="submit" variant="primary" class="cursor-pointer">Invite</flux:button>
                <flux:modal.close>
                    <flux:button variant="filled" class="cursor-pointer">Cancel</flux:button>
                </flux:modal.close>
            </div>
        </form>
    </div>
</flux:modal>