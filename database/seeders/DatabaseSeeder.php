<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Course;
use App\Models\Curriculum;
use App\Models\Lead;
use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        // Super Admin Permissions
        $default_permissions = ['lead management', 'create admin', 'user management'];
        foreach ($default_permissions as $permission) {
            Permission::create(['name' => $permission]);
        }

        // Create Users
        $this->create_user_with_role('Super Admin', 'Super Admin', 'super-admin@lms.test');
        $this->create_user_with_role('Communication', 'Communication Team', 'communication@lms.test');
        $this->create_user_with_role('Lead Manager', 'Lead Team', 'lead@lms.test');
        $teacher = $this->create_user_with_role('Teacher', 'Teacher', 'teacher@lms.test');

        // Create Leads
        Lead::factory(100)->create();

        // Create courses
        Course::create([
            'name' => 'Laravel',
            'description' => 'Laravel is a web application framework with expressive, elegant syntax. We’ve already laid the foundation — freeing you to create without sweating the small things.',
            'image' => 'https://laravel.com/img/logomark.min.svg',
            'price' => 380,
            'user_id' => $teacher->id
        ]);

        // Create curriculum
        Curriculum::factory(10)->create();
    }

    private function create_user_with_role($type, $name, $email) {
        $role = Role::create([
            'name' => $type
        ]);

        $user = User::create([
            'name' => $name,
            'email' => $email,
            'password' => bcrypt(123456)
        ]);

        if($type == 'Super Admin') {
            $role->givePermissionTo(Permission::all());
        } elseif ($type == 'Lead Manager') {
            $role->givePermissionTo('lead management');
        }

        $user->assignRole($role);

        return $user;
    }
}
