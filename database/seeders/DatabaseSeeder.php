<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            MasterTitleSeeder::class,
            MasterBankSeeder::class,
            MasterProvinceSeeder::class,
            MasterCitySeeder::class,
            MasterSubdistrictSeeder::class,
            MasterPaymentMethodSeeder::class,
            MasterIdentityTypeSeeder::class,
            MasterRelationshipSeeder::class,
            GraveSiteSeeder::class,
            GraveTypeSeeder::class,
            RolesSeeder::class,
            PermissionsSeeder::class,
            UserSeeder::class,
            // Add other seeders here as needed
        ]);
    }
}
