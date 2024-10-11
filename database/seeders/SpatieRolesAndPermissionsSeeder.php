<?php

namespace Database\Seeders;

use App\Enums\PermissionEnum;
use App\Enums\RoleEnum;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class SpatieRolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create Permissions
        foreach (PermissionEnum::cases() as $permission) {
            Permission::create(['name' => $permission->value]);
        }

        // Create Roles
        $superAdmin = Role::create(['name' => RoleEnum::SUPER_ADMIN->value]);
        $admin = Role::create(['name' => RoleEnum::ADMIN->value]);
        $staff = Role::create(['name' => RoleEnum::STAFF->value]);
        $securityGuard = Role::create(['name' => RoleEnum::SECURITY_GUARD->value]);

        // Assign permissions to roles
        // Super Admin gets all permissions
        $superAdmin->givePermissionTo(
            PermissionEnum::VIEW_QUEUES->value,
            PermissionEnum::CREATE_QUEUES->value,
            PermissionEnum::EDIT_QUEUES->value,
            PermissionEnum::DELETE_QUEUES->value,
            PermissionEnum::UPDATE_QUEUES_STATUSES->value,
            PermissionEnum::MARK_DONE_QUEUES->value,
            PermissionEnum::MARK_INQUIRED_QUEUES->value,
            PermissionEnum::MARK_HOLD_QUEUES->value
        );

        // Admin gets all permissions
        $admin->givePermissionTo(
            PermissionEnum::VIEW_QUEUES->value,
            PermissionEnum::CREATE_QUEUES->value,
            PermissionEnum::EDIT_QUEUES->value,
            PermissionEnum::DELETE_QUEUES->value,
            PermissionEnum::UPDATE_QUEUES_STATUSES->value,
            PermissionEnum::MARK_DONE_QUEUES->value,
            PermissionEnum::MARK_INQUIRED_QUEUES->value,
            PermissionEnum::MARK_HOLD_QUEUES->value
        );

        // Staff gets the basic queue permissions, but no delete and status updates
        $staff->givePermissionTo(
            PermissionEnum::VIEW_QUEUES->value,
            PermissionEnum::CREATE_QUEUES->value,
            PermissionEnum::EDIT_QUEUES->value,
            PermissionEnum::DELETE_QUEUES->value,
            PermissionEnum::UPDATE_QUEUES_STATUSES->value,
            PermissionEnum::MARK_DONE_QUEUES->value,
            PermissionEnum::MARK_INQUIRED_QUEUES->value,
            PermissionEnum::MARK_HOLD_QUEUES->value
        );

        // Security Guard only has permissions to view and mark queues
        $securityGuard->givePermissionTo(
            PermissionEnum::VIEW_QUEUES->value,
            PermissionEnum::CREATE_QUEUES->value,
            PermissionEnum::EDIT_QUEUES->value,
            PermissionEnum::DELETE_QUEUES->value,
        );
    }
}
