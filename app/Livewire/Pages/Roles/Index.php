<?php

namespace App\Livewire\Pages\Roles;

use App\Livewire\Forms\RoleForm;
use Illuminate\Support\Collection;
use Livewire\Attributes\Computed;
use Livewire\Component;
use Spatie\Permission\Models\Permission;

class Index extends Component
{
    public RoleForm $roleForm;
    public $roleModal = false;

    public function render()
    {
        return view('livewire.pages.roles.index');
    }

    #[Computed()]
    public function all_user_permissions()
    {
        return Permission::where('group', 'users')->get(['id', 'name', 'group', 'sub_group']);
    }

    #[Computed]
    public function all_queue_permissions(): Collection
    {
        // Fetch all queue-related permissions
        $queuePermissions = Permission::where('group', 'queues')->get();

        $crudPermissions = $queuePermissions->where('sub_group', null);
        $actionsPermissions = collect();

        // Gather action permissions
        foreach (['view', 'create', 'update', 'delete'] as $action) {
            // Get permissions for the current action
            $matchedPermissions = $queuePermissions->where('sub_group', $action);

            // Only push if there are matched permissions
            if ($matchedPermissions->isNotEmpty()) {
                $actionsPermissions->put($action, $matchedPermissions->values());
            }
        }

        // Prepare the final permissions structure
        $finalPermissions = $crudPermissions->map(function ($crudPermission) use ($actionsPermissions) {

            $crudAttributes = $crudPermission;

            $baseName = strtolower(str_replace('_queues', '', $crudPermission->name));

            if ($actionsPermissions->has($baseName)) {
                $crudAttributes['actions'] = $actionsPermissions->get($baseName);
            }

            return $crudAttributes;
        });

        return $finalPermissions;
    }

    public function save()
    {
        $this->roleForm->store();
    }
}
