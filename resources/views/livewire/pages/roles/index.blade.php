<x-custom.page-wrapper>
    <div class="flex justify-between items-center mb-4">
        <h2 class="text-2xl font-extrabold">Roles</h2>
        <x-ts-button x-on:click="$modalOpen('role-modal')">
            Create Roles
        </x-ts-button>
    </div>

    @include('livewire.pages.roles.partials.modal')
</x-custom.page-wrapper>
