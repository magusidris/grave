<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Idris',
            'email' => 'magusidris@undipa.ac.id',
            'phone' => '081234567890',
            'address' => 'Jl. Anuang no. 28, Makassar',
            'email_verified_at' => now(),
            'password' => bcrypt('Bismillah'),
        ]);
    }
}
