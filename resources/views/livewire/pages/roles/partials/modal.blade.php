<x-ts-modal id="role-modal" title="Create Role" size="sm" persistent center blur wire="roleModal">
    <form wire:submit="save" class="flex flex-col gap-2">
        <x-ts-input wire:model="roleForm.name" label="Name *" autocomplete="off" />
        <div>
            <h3>Permissions</h3>
            <div class="space-y-2">
                <div class="border rounded-md p-2 space-y-2">
                    <x-ts-checkbox wire:model="roleForm.user_all_permissions" label="Users" />
                    <div class="ml-7 space-y-2">
                        @foreach ($this->all_user_permissions as $permission)
                            <x-ts-checkbox wire:model="roleForm.user_all_permissions.{{ $permission->name }}"
                                label="{{ ucwords(trim(str_replace('_users', '', $permission->name))) }}" />
                        @endforeach
                    </div>
                </div>
                <div class="border rounded-md p-2 space-y-2">
                    <x-ts-checkbox label="Queues" />
                    <div class="ml-7 space-y-2">
                        {{-- @php
                            dd($this->all_queue_permissions);
                        @endphp --}}
                        @foreach ($this->all_queue_permissions as $permission)
                            <x-ts-checkbox label="{{ ucwords(trim(str_replace('_queues', '', $permission->name))) }}" />

                            {{-- Check if the permission has actions --}}
                            @if (isset($permission->actions) && $permission->actions->isNotEmpty())
                                <div class="ml-7 space-y-2">
                                    @foreach ($permission->actions as $action)
                                        <x-ts-checkbox
                                            label="{{ ucwords(trim(str_replace('_', ' ', str_replace('_queue', '', $action->name)))) }}" />
                                    @endforeach
                                </div>
                            @endif
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

        <div class="mt-4">
            <x-ts-button type="submit" text="Save" class="w-full" />
        </div>
    </form>
</x-ts-modal>
