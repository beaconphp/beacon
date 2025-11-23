<flux:modal name="create-user" class="md:min-w-md">
    <div class="space-y-6">
        <div class="flex items-center justify-between">
            <flux:heading size="lg">New user</flux:heading>
        </div>
        <form wire:submit="save" class="space-y-6">
            <div class="space-y-3">
                <flux:input label="Name" wire:model="name" placeholder="Enter name"/>
                <flux:input type="email" label="E-mail" wire:model="email" placeholder="Enter e-mail"/>
                <flux:input type="password" label="Password" wire:model="password" placeholder="Enter password" viewable/>
                <flux:radio.group wire:model="role" label="Role" variant="segmented">
                    @foreach(\App\Enums\UserRole::availableForCreate() as $role)
                        <flux:radio :label="$role->label()" :value="$role->value"/>
                    @endforeach
                </flux:radio.group>
                <flux:checkbox label="Send email with login information" wire:model="send_mail"/>
            </div>

            <div class="flex items-center gap-3">
                <flux:button type="submit" variant="primary" class="cursor-pointer">Create</flux:button>
                <flux:modal.close>
                    <flux:button variant="filled" class="cursor-pointer">Cancel</flux:button>
                </flux:modal.close>
            </div>
        </form>
    </div>
</flux:modal>