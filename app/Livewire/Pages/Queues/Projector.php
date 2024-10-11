<?php

namespace App\Livewire\Pages\Queues;

use App\Enums\QueueStatusEnum;
use App\Models\Queue;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('layouts.guest')]
class Projector extends Component
{
    public function render()
    {
        return view('livewire.pages.queues.projector');
    }

    #[Computed()]
    public function queue_waiting_list_()
    {
        return Queue::where('status', QueueStatusEnum::WAITING->value)->orderBy('updated_at', 'asc')->get();
    }

    #[Computed()]
    public function queue_calling_list_()
    {
        return Queue::where('status', QueueStatusEnum::CALLING->value)->orderBy('updated_at', 'asc')->get();
    }

    #[Computed()]
    public function queue_serving_list_()
    {
        return Queue::where('status', QueueStatusEnum::SERVING->value)->orderBy('updated_at', 'asc')->get();
    }
}
