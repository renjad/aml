<?php

namespace Database\Seeders;

use App\Enums\RoleEnum;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create the user manually for convenient login and assign the "admin" role
        User::withoutEvents(function () {
            $user = User::create([
                'name' => 'Super Admin User',
                'email' => 'superadmin@gmail.com',
                'password' => Hash::make('password'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            // Assign the "super admin" role to the user
            $user->assignRole(RoleEnum::SUPER_ADMIN->value);
        });
    }
}
