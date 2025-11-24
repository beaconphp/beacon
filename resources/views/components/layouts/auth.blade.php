@props([
	'heading' => null,
	'logo' => true
])
<x-layouts.base :title="$title">
    @push('styles')
        @fluxAppearance
    @endpush
    @push('scripts')
        @fluxScripts
    @endpush

    <x-slot:body>
        <div class="flex h-screen justify-center items-center">
            <div class="w-80 max-w-80 space-y-6">
                @if($logo)
                    <div class="flex justify-center mb-12">
                        <a href="{{ route('dashboard.tickets.index') }}" class="group flex items-center gap-3">
                            <x-logo class="h-7" :color="true"/>
                        </a>
                    </div>
                @endif

                @if($heading)
                    <flux:heading class="text-center" size="xl">{{ $heading }}</flux:heading>
                @endif

                {{ $slot }}
            </div>
        </div>
    </x-slot:body>
</x-layouts.base>