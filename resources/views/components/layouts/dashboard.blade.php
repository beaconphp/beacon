<x-layouts.base :title="$title">
    <x-slot:body class="min-h-screen">
        <flux:sidebar sticky collapsible="mobile">
            <div>
                <livewire:dashboard.workspace-selector/>

                <flux:sidebar.collapse class="lg:hidden" />
            </div>

            <flux:sidebar.nav>
                <flux:sidebar.item icon="ticket" icon:variant="solid" badge:color="lime" :href="route('dashboard.tickets.index')" :current="request()->routeIs('dashboard.tickets.*')">Tickets</flux:sidebar.item>
                <flux:sidebar.item icon="users" icon:variant="solid" :href="route('dashboard.users.index')" :current="request()->routeIs('dashboard.users.*')">Users</flux:sidebar.item>
            </flux:sidebar.nav>

            <flux:sidebar.spacer />

            <flux:sidebar.nav>
                <flux:sidebar.item icon="cog-6-tooth" icon:variant="solid" :href="route('dashboard.settings.workspace')" :current="request()->routeIs('dashboard.settings.*')">Settings</flux:sidebar.item>
            </flux:sidebar.nav>
        </flux:sidebar>

        <flux:header class="lg:hidden">
            <flux:sidebar.toggle class="lg:hidden" icon="bars-2" inset="left" />

            <flux:spacer />

            <livewire:dashboard.workspace-selector/>
        </flux:header>

        <flux:main class="m-2 bg-zinc-50 dark:bg-zinc-900 border rounded-lg border-zinc-200 dark:border-zinc-700">
            <flux:container>{{ $slot }}</flux:container>
        </flux:main>

        @persist('toasts')
            <livewire:toasts/>
        @endpersist
    </x-slot:body>
</x-layouts.base>