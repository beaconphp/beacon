<x-layouts.base title="Beacon">
    <x-slot:body class="w-screen flex justify-center items-center h-screen text-zinc-900 bg-zinc-50 dark:text-zinc-50 dark:bg-zinc-900">
        <div class="space-y-6 text-center">
            <x-logo class="h-10"/>
            @if(current_user()?->canAccessDashboard())
                <flux:button :href="route('dashboard.tickets.index')">Go to dashboard</flux:button>
            @endif
        </div>
    </x-slot:body>
</x-layouts.base>