<flux:modal name="edit-user" class="md:min-w-md">
    @if($user)
        <div class="space-y-6">
            <div class="flex items-center justify-between">
                <flux:heading size="lg">Edit user</flux:heading>
            </div>
            <form wire:submit="save" class="space-y-6">
                <div class="space-y-3">
                    <flux:input label="Name" wire:model="name" placeholder="Enter name"/>
                    <flux:input type="email" label="E-mail" wire:model="email" placeholder="Enter e-mail"/>
                    <flux:radio.group wire:model="role" label="Role" variant="segmented">
                        @foreach(\App\Enums\UserRole::availableForCreate() as $role)
                            <flux:radio :label="$role->label()" :value="$role->value"/>
                        @endforeach
                        @if($user->currentWorkspaceRole() === \App\Enums\UserRole::OWNER)
                            <flux:radio :label="\App\Enums\UserRole::OWNER->label()" :value="\App\Enums\UserRole::OWNER->value"/>
                        @endif
                    </flux:radio.group>
                </div>

                <div class="flex items-center gap-3">
                    <flux:button type="submit" variant="primary" class="cursor-pointer">Save changes</flux:button>
                    <flux:modal.close>
                        <flux:button variant="filled" class="cursor-pointer">Cancel</flux:button>
                    </flux:modal.close>
                </div>
            </form>
        </div>
    @endif
</flux:modal>