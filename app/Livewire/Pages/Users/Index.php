<?php

namespace App\Livewire\Pages\Users;

use App\Enums\RoleEnum;
use App\Livewire\Forms\UserForm;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Livewire\Attributes\Computed;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class Index extends Component
{
    use WithFileUploads, WithPagination;

    public UserForm $userForm;

    public $userModal = false;
    public array $selected = [];
    public ?int $quantity = 10;
    public ?string $search = null;
    public array $sort = [
        'column' => 'id',
        'direction' => 'desc',
    ];

    public function render()
    {
        return view('livewire.pages.users.index', [
            'headers' => [
                ['index' => 'id', 'label' => '#'],
                ['index' => 'name', 'label' => 'Users'],
            ],
            'rows' => User::query()
                ->when($this->search, function (Builder $query) {
                    return $query->where('name', 'like', "%{$this->search}%");
                })
                ->orderBy(...array_values($this->sort))
                ->paginate($this->quantity)
                ->withQueryString()
        ]);
    }

    #[Computed()]
    public function roles()
    {
        return collect(RoleEnum::cases())->map(function ($role) {
            return [
                'label' => $role->label(),
                'value' => $role->value,
            ];
        })->toArray();
    }

    public function save()
    {
        $this->userForm->store();

        $this->userModal = false;
    }
}
