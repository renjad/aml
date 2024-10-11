<x-ts-modal id="user-modal" title="Create User" size="sm" persistent center blur wire="userModal">
    <form wire:submit="save" class="flex flex-col gap-2">
        <x-ts-input wire:model="userForm.name" label="Name *" autocomplete="off" />
        <x-ts-input wire:model="userForm.email" label="Email *" suffix="@gmail.com" autocomplete="off" />
        <x-ts-password wire:model="userForm.password" label="Password *" />
        <x-ts-password wire:model="userForm.confirm_password" label="Confirm Password *" />
        <x-ts-upload wire:model="userForm.profile_photo" label="Profile Photo (Optional)" />
        <x-ts-select.styled wire:model="userForm.role" label="Role" :options="$this->roles"
            select="label:label|value:value" />

        <div class="mt-4">
            <x-ts-button type="submit" text="Save" class="w-full" />
        </div>
    </form>
</x-ts-modal>
