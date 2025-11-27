<div class="max-w-lg mx-auto space-y-6">
    <div class="space-y-6">
        <flux:heading size="xl">{{ $ticket->subject }}</flux:heading>
        <flux:text size="xl">{!! html_entity_decode($ticket->description) !!}</flux:text>
    </div>
    <flux:separator/>
</div>