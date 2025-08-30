<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\MasterIdentityType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class MasterIdentityTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        MasterIdentityType::insert([
            ['name' => 'KTP', 'description' => 'Kartu Tanda Penduduk'],
            ['name' => 'SIM', 'description' => 'Surat Izin Mengemudi'],
            ['name' => 'PASSPORT', 'description' => 'Paspor'],
        ]);
    }
}
