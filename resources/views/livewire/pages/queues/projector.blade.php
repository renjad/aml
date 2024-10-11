<div class="flex p-4" wire:poll.1s.keep-alive>
    <div class="basis-1/3">
        <p class="text-xl font-bold">Waiting</p>
        <div class="flex flex-col-reverse gap-3">
            @foreach ($this->queue_waiting_list as $item)
                <div class="w-56">
                    <x-ts-card class="flex justify-center items-center">
                        <p class="text-9xl">{{ $item->number }}</p>

                        <x-slot:footer>
                            <p class="w-full text-center">{{ $item->patient_name }}</p>
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
                    <x-ts-card class="flex justify-center items-center">
                        <p class="text-9xl">{{ $item->number }}</p>

                        <x-slot:footer>
                            <p class="w-full text-center">{{ $item->patient_name }}</p>
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
                    <x-ts-card class="flex justify-center items-center">
                        <p class="text-9xl">{{ $item->number }}</p>

                        <x-slot:footer>
                            <p class="w-full text-center">{{ $item->patient_name }}</p>
                        </x-slot:footer>
                    </x-ts-card>
                </div>
            @endforeach
        </div>
    </div>
</div>
