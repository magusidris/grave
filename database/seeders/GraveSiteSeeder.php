<?php

namespace Database\Seeders;

use App\Models\GraveSite;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class GraveSiteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        GraveSite::create([
            'name' => 'DPS Memorial Park',
            'province_id' => 28,
            'city_id' => 254,
            'address' => 'Jl. Perintis Kemerdekaan No.123, Makassar',
            'phone' => '0411-123456',
            'email' => 'info@dpsmemorialpark.com'
        ]);
    }
}
