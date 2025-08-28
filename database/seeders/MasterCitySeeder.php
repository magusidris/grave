<?php

namespace Database\Seeders;

use App\Models\MasterCity;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class MasterCitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // MasterCity::truncate();
        $csvFile = fopen(base_path('database/seeders/cities.csv'), 'r');

        while (($data = fgetcsv($csvFile, 2000, ',')) !== false) {
            MasterCity::create([
                'id' => $data['0'],
                'province_id' => $data['1'],
                'province' => $data['2'],
                'type' => $data['3'],
                'name' => $data['4'],
                'created_at' => $data['5'],
                'updated_at' => $data['6']
            ]);
        }
        fclose($csvFile);
    }
}
