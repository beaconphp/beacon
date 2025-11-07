<x-layouts.base :title="$title">
    <x-slot:body class="min-h-screen">
        <flux:sidebar sticky collapsible="mobile">
            <div>
                <livewire:dashboard.workspace-selector/>

                <flux:sidebar.collapse class="lg:hidden" />
            </div>

            <flux:sidebar.nav>
                <flux:sidebar.item icon="ticket" icon:variant="solid" badge:color="lime" href="{{ route('dashboard.tickets.index') }}" :current="request()->routeIs('dashboard.tickets.index')">Tickets</flux:sidebar.item>
                <flux:sidebar.item icon="users" icon:variant="solid">Users</flux:sidebar.item>
            </flux:sidebar.nav>

            <flux:sidebar.spacer />

            <flux:sidebar.nav>
                <flux:modal.trigger name="settings">
                    <flux:sidebar.item icon="cog-6-tooth" icon:variant="solid" href="#">Settings</flux:sidebar.item>
                </flux:modal.trigger>
            </flux:sidebar.nav>
        </flux:sidebar>

        <flux:header class="lg:hidden">
            <flux:sidebar.toggle class="lg:hidden" icon="bars-2" inset="left" />

            <flux:spacer />

            <livewire:dashboard.workspace-selector/>
        </flux:header>

        <flux:main class="m-2 bg-zinc-50 dark:bg-zinc-900 border rounded-lg border-zinc-200 dark:border-zinc-700">
            <flux:container>
                {{ $slot }}

                <flux:modal name="settings">
                    <flux:heading size="lg" class="mb-6">Settings</flux:heading>

                    <flux:radio.group x-data x-model="$flux.appearance" label="Select your theme" variant="segmented">
                        <flux:radio value="light" label="Light" icon="sun"/>
                        <flux:radio value="dark" label="Dark" icon="moon"/>
                        <flux:radio value="system" label="System" icon="computer-desktop"/>
                    </flux:radio.group>
                </flux:modal>
            </flux:container>
        </flux:main>
    </x-slot:body>
</x-layouts.base>