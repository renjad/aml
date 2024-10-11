<?php

namespace App\Livewire\Forms;

use App\Enums\QueueStatusEnum;
use App\Models\Queue;
use Illuminate\Validation\Rule;
use Livewire\Form;

class QueueForm extends Form
{
    public ?Queue $queues;

    public int $number;
    public ?string $patient_name = '';
    public QueueStatusEnum $status = QueueStatusEnum::WAITING;

    public function rules()
    {
        return [
            'number' => 'required|numeric',
            'patient_name' => 'nullable|string',
            'status' => [Rule::enum(QueueStatusEnum::class)],
        ];
    }

    public function setQueue($queue_id)
    {
        $queue = Queue::find($queue_id);

        $this->number = $queue->number;

        $this->patient_name = $queue->patient_name;

        $this->status = QueueStatusEnum::from($queue->status);
    }

    public function store()
    {
        $this->validate();

        $queue = Queue::create([
            'number' => $this->number,
            'patient_name' => $this->patient_name,
            'status' => $this->status->value,
            'created_by' => auth()->id(),
        ]);

        $this->reset(['patient_name']);

        return $queue;
    }
}
