<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\UserIdentity;
use App\Models\UserSign;
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
            'title_id' => 1,
            'name' => 'Idris',
            'email' => 'magusidris@undipa.ac.id',
            'phone' => '081234567890',
            'identity_type_id' => 1,
            'identity_number' => '7371101608910001',
            'address' => 'Jl. Anuang no. 28, Makassar',
            'email_verified_at' => now(),
            'password' => bcrypt('Bismillah'),
        ]);

        $user->sign()->create([
            'user_id' => $user->id,
            'type' => 'domestic',
            'site_id' => 1
        ]);

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
