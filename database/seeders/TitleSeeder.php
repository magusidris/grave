<?php

namespace Database\Seeders;

use App\Models\MasterTitle;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class TitleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        MasterTitle::insert([
            ['name' => 'Bpk.', 'description' => 'Bapak'],
            ['name' => 'Ibu.', 'description' => 'Ibu'],
            ['name' => 'Sdr.', 'description' => 'Saudara'],
            ['name' => 'Sdri.', 'description' => 'Saudari'],
        ]);
    }
}
