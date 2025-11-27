<div class="max-w-lg mx-auto space-y-6">
    <flux:heading size="xl">New ticket</flux:heading>
    <form wire:submit="save">
        <div class="space-y-4">
            <flux:heading>Contact information</flux:heading>
            <flux:field>
                <flux:input placeholder="Your name" wire:model="name"/>
                <flux:error name="name"/>
            </flux:field>
            <flux:field>
                <flux:input placeholder="Your e-mail address" wire:model="email"/>
                <flux:error name="email"/>
            </flux:field>
            <flux:field>
                <flux:input placeholder="Your phone number" wire:model="phone"/>
                <flux:error name="phone"/>
            </flux:field>
            <flux:heading>Ticket details</flux:heading>
            <flux:field>
                <flux:input placeholder="Short ticket name" wire:model="subject"/>
                <flux:error name="subject"/>
            </flux:field>
            <flux:field>
                <flux:textarea rows="6" placeholder="Properly describe your ticket" wire:model="description"/>
                <flux:error name="description"/>
            </flux:field>
            <flux:button type="submit" variant="primary" color="zinc" class="cursor-pointer w-full">Create</flux:button>
        </div>
    </form>
</div>
