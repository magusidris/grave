<?php

namespace Database\Seeders;

use App\Models\MasterBank;
use Illuminate\Support\Facades\File;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MasterBankSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // MasterCity::truncate();
        $jsonFile = File::get(base_path('database/seeders/bank.json'), 'r');

        $data = json_decode($jsonFile, true);
        foreach ($data as $item) {
            MasterBank::insert($item);
        }
    }
}
