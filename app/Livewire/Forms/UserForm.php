<?php

namespace App\Livewire\Forms;

use App\Enums\RoleEnum;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Livewire\Form;
use Livewire\WithFileUploads;

class UserForm extends Form
{
    use WithFileUploads;

    public string $name = '';
    public string $email = '';
    public string $password = 'password';
    public string $confirm_password = 'password';
    public string $role;
    public $profile_photo = null;

    public function rules()
    {
        return [
            'name' => 'required|string',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6',
            'confirm_password' => 'required|same:password',
            'profile_photo' => 'nullable|image|max:2048',
            'role' => 'required|in:' . implode(',', RoleEnum::values()),
        ];
    }

    public function store()
    {
        // Automatically append '@gmail.com' if not present
        if (!str_contains($this->email, '@gmail.com')) {
            $this->email .= '@gmail.com';
        }

        $this->validate();

        // Create user
        $user = User::create([
            'name' => $this->name,
            'email' => $this->email,
            'password' => Hash::make($this->password),
        ]);

        // Handle profile photo upload if present
        if ($this->profile_photo) {
            $user->updateProfilePhoto($this->profile_photo); // Jetstream method to handle photo
        }

        // Assign role to user
        $user->assignRole($this->role);

        $this->reset(['name', 'email', 'password', 'confirm_password', 'profile_photo']);
    }
}
