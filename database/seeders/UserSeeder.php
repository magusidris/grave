<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\UserIdentity;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::create([
            'title_id' => 3,
            'name' => 'Idris',
            'email' => 'magusidris@undipa.ac.id',
            'phone' => '081234567890',
            'email_verified_at' => now(),
            'password' => bcrypt('Bismillah'),
        ]);

        $detail = new UserIdentity;
        $detail->identity_type_id = 1;
        $detail->identity_number = '1234567890';
        $detail->address = 'Jl. Anuang no. 28, Makassar';
        $user->identity()->save($detail);

        // get all permissions
        $permissions = Permission::all();

        // get role programmer
        $role = Role::find(1);

        // assign permissions to role
        $role->syncPermissions($permissions);

        // assign role to user
        $user->assignRole($role);
    }
}
