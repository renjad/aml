<x-custom.page-wrapper>
    <div class="flex justify-between items-center mb-4">
        <h2 class="text-2xl font-extrabold">Users</h2>
        <x-ts-button x-on:click="$modalOpen('user-modal')">
            Create User
        </x-ts-button>
    </div>

    <div>
        <x-ts-table :$headers :$rows :$sort selectable wire:model="selected" paginate filter loading />
    </div>

    @include('livewire.pages.users.partials.modal')
</x-custom.page-wrapper>
