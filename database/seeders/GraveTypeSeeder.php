<?php

namespace Database\Seeders;

use App\Models\GraveType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class GraveTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        GraveType::create([
            'site_id' => 1,
            'name' => 'Medium',
            'width' => 120,
            'height' => 200,
            'price' => 7500000,
        ]);

        GraveType::create([
            'site_id' => 1,
            'name' => 'Large',
            'width' => 150,
            'height' => 200,
            'price' => 9000000,
        ]);
    }
}
