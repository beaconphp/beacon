<div class="max-w-lg mx-auto space-y-6">
    <div class="space-y-6">
        <flux:heading size="xl">{{ $ticket->subject }}</flux:heading>
        <flux:text size="xl">{!! html_entity_decode($ticket->description) !!}</flux:text>
    </div>
    <flux:separator/>
    <form wire:submit="comment" class="space-y-4">
        <flux:textarea label="Comment" wire:model="comment"/>
        <flux:button type="submit" variant="primary" color="zinc" class="cursor-pointer">Send</flux:button>
    </form>
    <flux:separator/>
</div>