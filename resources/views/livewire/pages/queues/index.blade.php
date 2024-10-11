<x-custom.page-wrapper>
    <div class="flex justify-between items-center">
        <h2 class="text-2xl font-extrabold">Queues</h2>
        <x-ts-button wire:click="resetForm()" x-on:click="$modalOpen('queue-modal')">
            Create Queue
        </x-ts-button>
    </div>

    <div class="flex">
        <div class="basis-1/3">
            <p class="text-xl font-bold">Waiting</p>
            <div class="flex flex-col-reverse gap-3">
                @foreach ($this->queue_waiting_list as $item)
                    <div class="w-56">
                        <x-ts-card :personalize="[
                            'header.wrapper' => [
                                'remove' => 'flex items-center justify-between',
                            ],
                        ]">
                            <x-slot:header>
                                <div class="flex justify-end items-center">
                                    <!-- Remove button -->
                                    <x-ts-button.circle wire:click="remove({{ $item->id }})" icon="x-mark"
                                        color="red" sm />
                                </div>
                            </x-slot:header>

                            <div wire:click="editQueue({{ $item->id }})" x-on:click="$modalOpen('queue-modal')"
                                class="flex justify-center items-center cursor-pointer">
                                <p class="text-9xl">{{ $item->number }}</p>
                            </div>

                            <x-slot:footer>
                                @can(\App\Enums\PermissionEnum::UPDATE_QUEUES_STATUSES->value)
                                    <div class="flex gap-1 w-full">
                                        <!-- Left arrow for moving status backward -->
                                        <x-ts-button wire:click="updateStatus({{ $item->id }}, 'left')"
                                            class="basis-1/2 w-full" color="slate" sm>
                                            <x-ts-icon name="arrow-long-left" class="w-6 h-6" />
                                        </x-ts-button>

                                        <!-- Right arrow for moving status forward -->
                                        <x-ts-button wire:click="updateStatus({{ $item->id }}, 'right')"
                                            class="basis-1/2 w-full" color="slate" sm>
                                            <x-ts-icon name="arrow-long-right" class="w-6 h-6" />
                                        </x-ts-button>
                                    </div>
                                @endcan
                            </x-slot:footer>
                        </x-ts-card>
                    </div>
                @endforeach
            </div>
        </div>
        <div class="basis-1/3">
            <p class="text-xl font-bold">Calling</p>
            <div class="flex flex-col-reverse gap-3">
                @foreach ($this->queue_calling_list_ as $item)
                    <div class="w-56">
                        <x-ts-card :personalize="[
                            'header.wrapper' => [
                                'remove' => 'flex items-center justify-between',
                            ],
                        ]">
                            <x-slot:header>
                                <div class="flex justify-end items-center">
                                    <!-- Remove button -->
                                    <x-ts-button.circle wire:click="remove({{ $item->id }})" icon="x-mark"
                                        color="red" sm />
                                </div>
                            </x-slot:header>

                            <div wire:click="editQueue({{ $item->id }})" x-on:click="$modalOpen('queue-modal')"
                                class="flex justify-center items-center cursor-pointer">
                                <p class="text-9xl">{{ $item->number }}</p>
                            </div>

                            <x-slot:footer>
                                @can(\App\Enums\PermissionEnum::UPDATE_QUEUES_STATUSES->value)
                                    <div class="flex gap-1 w-full">
                                        <!-- Left arrow for moving status backward -->
                                        <x-ts-button wire:click="updateStatus({{ $item->id }}, 'left')"
                                            class="basis-1/2 w-full" color="slate" sm>
                                            <x-ts-icon name="arrow-long-left" class="w-6 h-6" />
                                        </x-ts-button>

                                        @can(\App\Enums\PermissionEnum::MARK_HOLD_QUEUES->value)
                                            <x-ts-button wire:click="hold({{ $item->id }})" text="Hold" color="blue"
                                                sm />
                                        @endcan

                                        <!-- Right arrow for moving status forward -->
                                        <x-ts-button wire:click="updateStatus({{ $item->id }}, 'right')"
                                            class="basis-1/2 w-full" color="slate" sm>
                                            <x-ts-icon name="arrow-long-right" class="w-6 h-6" />
                                        </x-ts-button>
                                    </div>
                                @endcan
                            </x-slot:footer>
                        </x-ts-card>
                    </div>
                @endforeach
            </div>
        </div>
        <div class="basis-1/3">
            <p class="text-xl font-bold">Serving</p>
            <div class="flex flex-col-reverse gap-3">
                @foreach ($this->queue_serving_list as $item)
                    <div class="w-56">
                        <x-ts-card :personalize="[
                            'header.wrapper' => [
                                'remove' => 'flex items-center justify-between',
                            ],
                        ]">
                            <x-slot:header>

                                <div class="flex justify-between items-center">
                                    @can(\App\Enums\PermissionEnum::MARK_INQUIRED_QUEUES->value)
                                        <x-ts-button wire:click="inquired({{ $item->id }})" text="Inquired" sm />
                                    @endcan
                                    <!-- Remove button -->
                                    <x-ts-button.circle wire:click="remove({{ $item->id }})" icon="x-mark"
                                        color="red" sm />
                                </div>

                            </x-slot:header>

                            <div wire:click="editQueue({{ $item->id }})" x-on:click="$modalOpen('queue-modal')"
                                class="flex justify-center items-center cursor-pointer">
                                <p class="text-9xl">{{ $item->number }}</p>
                            </div>

                            <x-slot:footer>
                                @can(\App\Enums\PermissionEnum::UPDATE_QUEUES_STATUSES->value)
                                    <div class="flex gap-1 w-full">
                                        <!-- Left arrow for moving status backward -->
                                        <x-ts-button wire:click="updateStatus({{ $item->id }}, 'left')"
                                            class="basis-1/2 w-full" color="slate" sm>
                                            <x-ts-icon name="arrow-long-left" class="w-6 h-6" />
                                        </x-ts-button>

                                        @can(\App\Enums\PermissionEnum::MARK_DONE_QUEUES->value)
                                            <x-ts-button wire:click="served({{ $item->id }})" text="Done" color="green"
                                                sm />
                                        @endcan

                                        <!-- Right arrow for moving status forward -->
                                        <x-ts-button wire:click="updateStatus({{ $item->id }}, 'right')"
                                            class="basis-1/2 w-full" color="slate" sm>
                                            <x-ts-icon name="arrow-long-right" class="w-6 h-6" />
                                        </x-ts-button>
                                    </div>
                                @endcan
                            </x-slot:footer>
                        </x-ts-card>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    @include('livewire.pages.queues.partials.modal')
</x-custom.page-wrapper>
