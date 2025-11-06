<div class="space-y-6">
    <form wire:submit="authenticate" class="flex flex-col gap-6">
        <flux:input label="Email" type="email" wire:model.live.debounce350ms="email" placeholder="email@example.com"/>
        <flux:input label="Password" type="password" wire:model.live.debounce350ms="password" placeholder="Your password"/>

        <flux:checkbox wire:model.live.debounce350ms="remember" label="Remember me for 30 days"/>

        <flux:button type="submit" variant="primary" class="w-full cursor-pointer">Log in</flux:button>
    </form>
</div>
