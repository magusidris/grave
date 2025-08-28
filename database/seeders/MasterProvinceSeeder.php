<?php

namespace Database\Seeders;

use App\Models\MasterProvince;
use Illuminate\Database\Seeder;

class MasterProvinceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // MasterProvince::truncate();
        $csvFile = fopen(base_path('database/seeders/provinces.csv'), 'r');

        while (($data = fgetcsv($csvFile, 2000, ',')) !== false) {
            MasterProvince::create([
                'id' => $data['0'],
                'name' => $data['1'],
                'created_at' => $data['2'],
                'updated_at' => $data['3']
            ]);
        }
        fclose($csvFile);
    }
}
