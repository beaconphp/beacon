<div class="fixed bottom-5 right-5 z-50 flex flex-col space-y-2 w-max">
    @foreach($toasts as $message)
        <div x-data="{ visible: true }" x-init="setTimeout(() => visible = false, 3000)" x-show="visible" x-collapse>
            <div x-show="visible" x-transition>
                <flux:callout :icon="$message['icon']" :variant="$message['variant']" class="min-w-sm">
                    @if($message['heading'])
                        <flux:callout.heading>{{ $message['heading'] }}</flux:callout.heading>
                    @endif

                    <flux:callout.text>{{ $message['text'] }}</flux:callout.text>

                    <x-slot name="controls">
                        <flux:button icon="x-mark" variant="ghost" x-on:click="visible = false" />
                    </x-slot>
                </flux:callout>
            </div>
        </div>
    @endforeach
</div>
