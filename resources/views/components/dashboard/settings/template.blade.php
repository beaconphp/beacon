<div>
    <div class="relative mb-6 w-full">
        <flux:heading size="xl" level="1" class="mb-6">Settings</flux:heading>
        <flux:separator variant="subtle"/>
    </div>
    <div class="flex items-start max-md:flex-col">
        <div class="me-10 w-full pb-4 md:w-[220px]">
            <flux:navlist>
                <flux:navlist.item :href="route('dashboard.settings.workspace')" wire:navigate>Workspace</flux:navlist.item>
                <flux:navlist.item :href="route('dashboard.settings.account')" wire:navigate>Account</flux:navlist.item>
            </flux:navlist>
        </div>

        <flux:separator class="md:hidden" />

        <div class="flex-1 self-stretch max-md:pt-6">{{ $slot }}</div>
    </div>
</div>