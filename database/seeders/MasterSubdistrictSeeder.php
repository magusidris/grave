<?php

namespace Database\Seeders;

use App\Models\MasterSubdistrict;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MasterSubdistrictSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // MasterSubdistrict::truncate();
        $csvFile = fopen(base_path('database/seeders/subdistricts.csv'), 'r');

        while (($data = fgetcsv($csvFile, 2000, ',')) !== false) {
            MasterSubdistrict::create([
                'id' => $data['0'],
                'province_id' => $data['1'],
                'province' => $data['2'],
                'city_id' => $data['3'],
                'city' => $data['4'],
                'type' => $data['5'],
                'name' => $data['6'],
                'created_at' => $data['7'],
                'updated_at' => $data['8']
            ]);
        }
        fclose($csvFile);
    }
}
