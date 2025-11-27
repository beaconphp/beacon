<x-layouts.base :title="$currentWorkspace->name">
    @push('scripts')
        @fluxScripts
    @endpush

    <x-slot:body>
        <flux:header container class="bg-zinc-50 dark:bg-zinc-900 border-b border-zinc-200 dark:border-zinc-700">
            <flux:brand :name="$currentWorkspace->name" :href="route('workspace.show', ['workspace' => $currentWorkspace])"/>
            <flux:navbar class="-mb-px max-lg:hidden">
                <flux:navbar.item href="#">My tickets</flux:navbar.item>
            </flux:navbar>
            <flux:spacer />
            @auth
                <flux:dropdown position="top" align="end">
                    <flux:profile :name="current_user()->name"/>
                    <flux:menu>
                        <flux:menu.separator />
                        <form action="{{ route('logout') }}" method="post">
                            @csrf
                            <flux:menu.item type="submit" icon="arrow-right-start-on-rectangle" class="cursor-pointer">Logout</flux:menu.item>
                        </form>
                    </flux:menu>
                </flux:dropdown>
            @else
                <flux:button :href="route('login', ['workspace' => $currentWorkspace])" size="sm" icon="arrow-left-start-on-rectangle">Log in</flux:button>
            @endauth
        </flux:header>
        <flux:main container>{{ $slot }}</flux:main>
    </x-slot:body>
</x-layouts.base>