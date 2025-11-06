<x-layouts.base :title="$title">
    <x-slot:body class="min-h-screen">
        <flux:sidebar sticky collapsible="mobile" class="bg-zinc-50 dark:bg-zinc-900 border-r border-zinc-200 dark:border-zinc-700">
            <div>
                <livewire:dashboard.workspace-selector/>

                <flux:sidebar.collapse class="lg:hidden" />
            </div>

            <flux:sidebar.nav>
                <flux:sidebar.item icon="ticket" icon:variant="solid" badge:color="lime" href="{{ route('dashboard.tickets.index') }}" :current="request()->routeIs('dashboard.tickets.index')">Tickets</flux:sidebar.item>
            </flux:sidebar.nav>

            <flux:sidebar.spacer />

            <flux:sidebar.nav>
                <flux:sidebar.item icon="cog-6-tooth" icon:variant="solid" href="#">Settings</flux:sidebar.item>
            </flux:sidebar.nav>
        </flux:sidebar>

        <flux:header class="lg:hidden">
            <flux:sidebar.toggle class="lg:hidden" icon="bars-2" inset="left" />

            <flux:spacer />

            <flux:dropdown position="top" alignt="start">
                <flux:profile avatar="https://fluxui.dev/img/demo/user.png" />

                <flux:menu>
                    <flux:menu.radio.group>
                        <flux:menu.radio checked>Olivia Martin</flux:menu.radio>
                        <flux:menu.radio>Truly Delta</flux:menu.radio>
                    </flux:menu.radio.group>

                    <flux:menu.separator />

                    <flux:menu.item icon="arrow-right-start-on-rectangle">Logout</flux:menu.item>
                </flux:menu>
            </flux:dropdown>
        </flux:header>

        <flux:main>{{ $slot }}</flux:main>
    </x-slot:body>
</x-layouts.base>