<?php

namespace App\Livewire\Pages\Queues;

use App\Enums\QueueStatusEnum;
use App\Livewire\Forms\QueueForm;
use App\Models\Queue;
use Livewire\Attributes\Computed;
use Livewire\Component;

class Index extends Component
{
    public QueueForm $queue;

    public $queueModal = false;

    public function mount()
    {
        $this->resetForm();
    }

    public function render()
    {
        return view('livewire.pages.queues.index');
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

    public function save()
    {
        // Check if the queue number already exists for today
        $existingQueue = Queue::where('number', $this->queue->number)
            ->whereDate('created_at', now()->format('Y-m-d'))
            ->first();

        if ($existingQueue) {
            // Handle the case where the queue number is already taken
            session()->flash('error', 'Queue number already exists for today. Please try again.');
            session()->flash('unique_toast_id', uniqid());
            return;
        }

        $queue = $this->queue->store();

        $this->queue->number = $queue->number + 1;
        $this->queueModal = false;
    }

    public function editQueue($queue_id)
    {
        $this->queue->setQueue($queue_id);
    }

    public function updateStatus($id, $direction)
    {
        // Define the order of statuses using the enum
        $statuses = [
            QueueStatusEnum::WAITING,
            QueueStatusEnum::CALLING,
            QueueStatusEnum::SERVING,
        ];

        // Find the queue item by its id
        $queueItem = Queue::find($id);

        if ($queueItem) {
            // Get the current status of the item as an enum instance
            $currentStatus = QueueStatusEnum::from($queueItem->status);

            // Find the index of the current status in the statuses array
            $currentIndex = array_search($currentStatus, $statuses);

            // Determine the new index based on the direction
            if ($direction === 'right' && $currentIndex < count($statuses) - 1) {
                $newIndex = $currentIndex + 1;
            } elseif ($direction === 'left' && $currentIndex > 0) {
                $newIndex = $currentIndex - 1;
            } else {
                $newIndex = $currentIndex; // Stay at the same status if no transition is possible
            }

            // Update the status of the queue item with the new status (as string)
            $queueItem->update(['status' => $statuses[$newIndex]->value]);
        }

        // Refresh the component
        $this->mount();
    }

    public function served($id)
    {
        // Find the queue item by its id and update the status
        Queue::find($id)->update(['status' => QueueStatusEnum::SERVED->value]);
        $this->mount();
    }

    public function inquired($id)
    {
        // Find the queue item by its id and update the status
        Queue::find($id)->update(['status' => QueueStatusEnum::INQUIRED->value]);
        $this->mount();
    }

    public function hold($id)
    {
        // Find the queue item by its id and update the status
        Queue::find($id)->update(['status' => QueueStatusEnum::HOLD->value]);
        $this->mount();
    }

    public function remove($id)
    {
        // Find the queue item by its id
        $queueItem = Queue::find($id);

        if ($queueItem) {
            // Update the removed_by column with the authenticated user's ID
            $queueItem->removed_by = auth()->id();
            $queueItem->save();

            // Now delete the item
            $queueItem->delete();
        }

        $this->mount();
    }

    public function resetForm()
    {
        // Fetch today's queues and get the next available number
        $today = now()->format('Y-m-d');
        $lastQueue = Queue::whereDate('created_at', $today)->latest('number')->first();
        $this->queue->number = $lastQueue ? $lastQueue->number + 1 : 1;
        $this->queue->patient_name = '';
    }
}
