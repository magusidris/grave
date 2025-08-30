<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //permission for roles
        Permission::create(['name' => 'dashboard.director']);
        Permission::create(['name' => 'dashboard.manager']);
        Permission::create(['name' => 'dashboard.admin']);
        Permission::create(['name' => 'dashboard.staff']);

        Permission::create(['name' => 'customers.index']);
        Permission::create(['name' => 'customers.create']);
        Permission::create(['name' => 'customers.edit']);
        Permission::create(['name' => 'customers.delete']);

        Permission::create(['name' => 'masterprovinces.index']);
        Permission::create(['name' => 'mastercities.index']);
        Permission::create(['name' => 'mastersubdistricts.index']);
        Permission::create(['name' => 'mastertitles.index']);
        Permission::create(['name' => 'masteridentities.index']);
        Permission::create(['name' => 'masterrelationships.index']);
        Permission::create(['name' => 'masterpaymentmethods.index']);

        //permission for roles
        Permission::create(['name' => 'roles.index']);
        Permission::create(['name' => 'roles.create']);
        Permission::create(['name' => 'roles.edit']);
        Permission::create(['name' => 'roles.delete']);

        //permission for permissions
        Permission::create(['name' => 'permissions.index']);

        //permission for users
        Permission::create(['name' => 'users.index']);
        Permission::create(['name' => 'users.create']);
        Permission::create(['name' => 'users.edit']);
        Permission::create(['name' => 'users.delete']);

        Permission::create(['name' => 'graveclusters.index']);
        Permission::create(['name' => 'graveclusters.create']);
        Permission::create(['name' => 'graveclusters.edit']);
        Permission::create(['name' => 'graveclusters.delete']);

        Permission::create(['name' => 'graveblocks.index']);
        Permission::create(['name' => 'graveblocks.create']);
        Permission::create(['name' => 'graveblocks.edit']);
        Permission::create(['name' => 'graveblocks.delete']);

        Permission::create(['name' => 'gravetypes.index']);
        Permission::create(['name' => 'gravetypes.create']);
        Permission::create(['name' => 'gravetypes.edit']);
        Permission::create(['name' => 'gravetypes.delete']);

        Permission::create(['name' => 'graves.index']);
        Permission::create(['name' => 'graves.create']);
        Permission::create(['name' => 'graves.edit']);
        Permission::create(['name' => 'graves.delete']);

        Permission::create(['name' => 'transactions.index']);

        Permission::create(['name' => 'orders.index']);

        Permission::create(['name' => 'sales.index']);

        Permission::create(['name' => 'paymentagreements.index']);

        Permission::create(['name' => 'installments.index']);

        Permission::create(['name' => 'invoices.index']);

        Permission::create(['name' => 'invoicepayments.index']);
    }
}
