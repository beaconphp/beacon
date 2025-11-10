<x-dashboard.settings.template>
    <div class="max-w-md space-y-12">
        <form wire:submit="updatePassword" class="space-y-4">
            <flux:input type="password" label="Current password" wire:model.live.debounce350ms="current_password" placeholder="Enter current password" viewable/>
            <flux:input type="password" label="New password" wire:model.live.debounce350ms="password" placeholder="Enter new password" viewable/>
            <flux:input type="password" label="Confirm new password" wire:model.live.debounce350ms="password_confirmation" placeholder="Confirm new password" viewable/>
            <flux:button variant="primary" type="submit" class="cursor-pointer">Update password</flux:button>
        </form>
        <flux:separator/>
        <div>
            <flux:radio.group x-data x-model="$flux.appearance" label="Appearance" description="Select your theme" variant="segmented">
                <flux:radio value="light" label="Light" icon="sun"/>
                <flux:radio value="dark" label="Dark" icon="moon"/>
                <flux:radio value="system" label="System" icon="computer-desktop"/>
            </flux:radio.group>
        </div>
    </div>
</x-dashboard.settings.template>