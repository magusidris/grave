<?php

namespace Database\Seeders;

use App\Models\MasterEmergencyRelationship;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MasterRelationshipSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        MasterEmergencyRelationship::insert([
            ['name' => 'Istri', 'description' => 'Hubungan Istri'],
            ['name' => 'Suami', 'description' => 'Hubungan Suami'],
            ['name' => 'Bapak', 'description' => 'Hubungan Bapak'],
            ['name' => 'Ibu', 'description' => 'Hubungan Ibu'],
            ['name' => 'Wali', 'description' => 'Hubungan Wali'],
            ['name' => 'Saudara', 'description' => 'Hubungan Saudara'],
            ['name' => 'Saudari', 'description' => 'Hubungan Saudari'],
            ['name' => 'Anak', 'description' => 'Hubungan Anak'],
            ['name' => 'Lainnya', 'description' => 'Hubungan Lainnya'],
        ]);
    }
}
