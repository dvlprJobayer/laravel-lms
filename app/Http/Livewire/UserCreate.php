<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;
use Spatie\Permission\Models\Role;

class UserCreate extends Component
{
    public $name;
    public $email;
    public $password;
    public $role;

    public function render()
    {
        $roles = Role::where('name', '!=', 'Super Admin')->get();
        return view('livewire.user-create', compact('roles'));
    }

    public function addUser () {
        $this->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6',
            'role' => 'required'
        ]);

        $user = User::create([
            'name' => $this->name,
            'email' => $this->email,
            'password' => bcrypt($this->password)
        ]);

        $user->assignRole($this->role);

        flash()->addSuccess('User created successfully!');
        return redirect()->route('user.index');
    }
}
