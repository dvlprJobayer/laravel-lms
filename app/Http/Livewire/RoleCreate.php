<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleCreate extends Component
{
    public $name;
    public $selected_permissions = [];
    public function render()
    {
        $permissions = Permission::all();
        return view('livewire.role-create', compact('permissions'));
    }

    public function addRole () {
        $this->validate([
            'name' => 'required|unique:roles,name',
            'selected_permissions' => 'required|array|min:1'
        ]);

        $role = Role::create(['name' => $this->name]);
        $role->syncPermissions($this->selected_permissions);
        flash()->addSuccess('Role created successfully!');
        return redirect()->route('role.index');
    }
}
