<x-dashboard.settings.template>
    <div class="max-w-md space-y-12">
        <form wire:submit="update" class="space-y-4">
            <flux:input label="Name" wire:model.live.debounce350ms="name" placeholder="Enter workspace name"/>

            <flux:field>
                <flux:label>Workspace URL</flux:label>

                <flux:input.group>
                    <flux:input wire:model.live.debounce350ms="slug" placeholder="Enter workspace slug"/>
                    <flux:input.group.suffix>.{{ config('app.domain') }}</flux:input.group.suffix>
                </flux:input.group>

                <flux:error name="slug"/>
            </flux:field>

            <div x-data="{ edit: {{ $workspace->avatar ? 'false' : 'true' }} }">
                <div x-show="!edit">
                    <flux:label class="mb-2">Avatar</flux:label>
                    <div>
                        <button type="button" @click="edit = !edit" class="cursor-pointer relative group">
                        <span class="absolute  cleft-0 top-0 z-10 size-full flex justify-center items-center opacity-0 group-hover:opacity-100 text-zinc-800 bg-white/70 transition-opacity rounded-lg">
                            <flux:icon.pencil class="size-5"/>
                        </span>
                            <flux:avatar :src="$workspace->avatar_url" size="xl"/>
                        </button>
                    </div>
                </div>
                <div x-show="edit">
                    <flux:input type="file" wire:model="avatar" label="Avatar"/>
                </div>
            </div>

            <flux:button variant="primary" type="submit">Save</flux:button>
        </form>

        <flux:separator/>

        <div>
            <flux:heading>Delete workspace</flux:heading>
            <flux:subheading class="mb-6">Delete this workspace and all of its resources</flux:subheading>

            <flux:modal.trigger name="delete-workspace">
                <flux:button variant="danger">Delete workspace</flux:button>
            </flux:modal.trigger>
        </div>
    </div>

    <flux:modal name="delete-workspace" class="space-y-6">
        <div>
            <flux:heading size="lg">Are you sure you want to delete this workspace ?</flux:heading>
            <flux:subheading>Please enter workspace name to confirm you would like to permanently delete this workspace.</flux:subheading>
        </div>

        <flux:input label="Enter workspace name" wire:model.live.debounce350ms="delete_workspace_name" :placeholder="$workspace->name"/>

        <div class="flex justify-end space-x-2">
            <flux:modal.close>
                <flux:button>Cancel</flux:button>
            </flux:modal.close>

            <flux:button variant="danger" wire:click="delete">Confirm deletion</flux:button>
        </div>
    </flux:modal>
</x-dashboard.settings.template>