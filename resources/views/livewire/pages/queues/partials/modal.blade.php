<x-ts-modal id="queue-modal" title="Create Queue" size="sm" persistent center blur wire="queueModal">
    <div>
        <form wire:submit="save" class="flex flex-col gap-2">
            @if (Session::has('error'))
                <div class="flex items-center gap-1 text-red-500 p-2 rounded-md border border-red-500">
                    <x-ts-icon name="x-circle" class="h-5 w-5" outline />
                    <span>Patient queue number is already used.</span>
                </div>
            @endif
            <x-ts-input wire:model="queue.patient_name" label="Name" autocomplete="off" />
            <x-ts-number wire:model="queue.number" label="Queue Number" min="1" centralized />
            <div class="mt-4">
                <x-ts-button type="submit" text="Save" class="w-full" />
            </div>
        </form>
    </div>
</x-ts-modal>
