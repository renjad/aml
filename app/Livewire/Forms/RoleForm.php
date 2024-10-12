<?php

namespace App\Livewire\Forms;

use Livewire\Attributes\Validate;
use Livewire\Form;

class RoleForm extends Form
{
    public string $name = '';

    public array $user_all_permissions = [];

    public function store()
    {
        dd($this->user_all_permissions);
    }
}
