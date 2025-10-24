<?php

namespace Database\Seeders;

use App\Models\GraveCluster;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class GraveClusterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        GraveCluster::create([
            'site_id' => 1,
            'name' => 'Firdaus',
            'description' => 'This is Cluster Firdaus',
            'sequence' => 1,
        ])->blocks()->createMany([
            ['name' => 'A1', 'description' => 'This is Block A1', 'sequence' => 1],
            ['name' => 'A2', 'description' => 'This is Block A2', 'sequence' => 2],
            ['name' => 'A3', 'description' => 'This is Block A3', 'sequence' => 3],
            ['name' => 'A4', 'description' => 'This is Block A4', 'sequence' => 4],
            ['name' => 'A5', 'description' => 'This is Block A5', 'sequence' => 5],
            ['name' => 'A6', 'description' => 'This is Block A6', 'sequence' => 6],
            ['name' => 'A7', 'description' => 'This is Block A7', 'sequence' => 7],
            ['name' => 'A8', 'description' => 'This is Block A8', 'sequence' => 8]
        ]);

        GraveCluster::create([
            'site_id' => 1,
            'name' => 'Adn',
            'description' => 'This is Cluster Adn',
            'sequence' => 2,
        ])->blocks()->createMany([
            ['name' => 'B1', 'description' => 'This is Block B1', 'sequence' => 1],
            ['name' => 'B2', 'description' => 'This is Block B2', 'sequence' => 2],
            ['name' => 'B3', 'description' => 'This is Block B3', 'sequence' => 3],
            ['name' => 'B4', 'description' => 'This is Block B4', 'sequence' => 4],
            ['name' => 'B5', 'description' => 'This is Block B5', 'sequence' => 5],
            ['name' => 'B6', 'description' => 'This is Block B6', 'sequence' => 6],
            ['name' => 'B7', 'description' => 'This is Block B7', 'sequence' => 7],
            ['name' => 'B8', 'description' => 'This is Block B8', 'sequence' => 8]
        ]);

        GraveCluster::create([
            'site_id' => 1,
            'name' => "Na'im",
            'description' => "This is Cluster Na'im",
            'sequence' => 3,
        ])->blocks()->createMany([
            ['name' => 'C1', 'description' => 'This is Block C1', 'sequence' => 1],
            ['name' => 'C2', 'description' => 'This is Block C2', 'sequence' => 2],
            ['name' => 'C3', 'description' => 'This is Block C3', 'sequence' => 3],
            ['name' => 'C4', 'description' => 'This is Block C4', 'sequence' => 4],
            ['name' => 'C5', 'description' => 'This is Block C5', 'sequence' => 5],
            ['name' => 'C6', 'description' => 'This is Block C6', 'sequence' => 6],
            ['name' => 'C7', 'description' => 'This is Block C7', 'sequence' => 7],
            ['name' => 'C8', 'description' => 'This is Block C8', 'sequence' => 8]
        ]);

        GraveCluster::create([
            'site_id' => 1,
            'name' => "Ma'wa",
            'description' => "This is Cluster Ma'wa",
            'sequence' => 4,
        ])->blocks()->createMany([
            ['name' => 'D1', 'description' => 'This is Block D1', 'sequence' => 1],
            ['name' => 'D2', 'description' => 'This is Block D2', 'sequence' => 2],
            ['name' => 'D3', 'description' => 'This is Block D3', 'sequence' => 3],
            ['name' => 'D4', 'description' => 'This is Block D4', 'sequence' => 4],
            ['name' => 'D5', 'description' => 'This is Block D5', 'sequence' => 5],
            ['name' => 'D6', 'description' => 'This is Block D6', 'sequence' => 6],
            ['name' => 'D7', 'description' => 'This is Block D7', 'sequence' => 7],
            ['name' => 'D8', 'description' => 'This is Block D8', 'sequence' => 8]
        ]);

        GraveCluster::create([
            'site_id' => 1,
            'name' => 'Darussalam',
            'description' => "This is Cluster Darussalam",
            'sequence' => 5,
        ])->blocks()->createMany([
            ['name' => 'E1', 'description' => 'This is Block E1', 'sequence' => 1],
            ['name' => 'E2', 'description' => 'This is Block E2', 'sequence' => 2],
            ['name' => 'E3', 'description' => 'This is Block E3', 'sequence' => 3],
            ['name' => 'E4', 'description' => 'This is Block E4', 'sequence' => 4],
            ['name' => 'E5', 'description' => 'This is Block E5', 'sequence' => 5],
            ['name' => 'E6', 'description' => 'This is Block E6', 'sequence' => 6],
            ['name' => 'E7', 'description' => 'This is Block E7', 'sequence' => 7],
            ['name' => 'E8', 'description' => 'This is Block E8', 'sequence' => 8]
        ]);

        GraveCluster::create([
            'site_id' => 1,
            'name' => 'Darul Muqamah',
            'description' => "This is Cluster Darul Muqamah",
            'sequence' => 6,
        ])->blocks()->createMany([
            ['name' => 'F1', 'description' => 'This is Block F1', 'sequence' => 1],
            ['name' => 'F2', 'description' => 'This is Block F2', 'sequence' => 2],
            ['name' => 'F3', 'description' => 'This is Block F3', 'sequence' => 3],
            ['name' => 'F4', 'description' => 'This is Block F4', 'sequence' => 4],
            ['name' => 'F5', 'description' => 'This is Block F5', 'sequence' => 5],
            ['name' => 'F6', 'description' => 'This is Block F6', 'sequence' => 6],
            ['name' => 'F7', 'description' => 'This is Block F7', 'sequence' => 7],
            ['name' => 'F8', 'description' => 'This is Block F8', 'sequence' => 8]
        ]);

        GraveCluster::create([
            'site_id' => 1,
            'name' => 'Maqamul Amin',
            'description' => "This is Cluster Maqamul Amin",
            'sequence' => 7,
        ])->blocks()->createMany([
            ['name' => 'G1', 'description' => 'This is Block G1', 'sequence' => 1],
            ['name' => 'G2', 'description' => 'This is Block G2', 'sequence' => 2],
            ['name' => 'G3', 'description' => 'This is Block G3', 'sequence' => 3],
            ['name' => 'G4', 'description' => 'This is Block G4', 'sequence' => 4],
            ['name' => 'G5', 'description' => 'This is Block G5', 'sequence' => 5],
            ['name' => 'G6', 'description' => 'This is Block G6', 'sequence' => 6],
            ['name' => 'G7', 'description' => 'This is Block G7', 'sequence' => 7],
            ['name' => 'G8', 'description' => 'This is Block G8', 'sequence' => 8]
        ]);

        GraveCluster::create([
            'site_id' => 1,
            'name' => 'Khuldi',
            'description' => "This is Cluster Khuldi",
            'sequence' => 8,
        ])->blocks()->createMany([
            ['name' => 'H1', 'description' => 'This is Block H1', 'sequence' => 1],
            ['name' => 'H2', 'description' => 'This is Block H2', 'sequence' => 2],
            ['name' => 'H3', 'description' => 'This is Block H3', 'sequence' => 3],
            ['name' => 'H4', 'description' => 'This is Block H4', 'sequence' => 4],
            ['name' => 'H5', 'description' => 'This is Block H5', 'sequence' => 5],
            ['name' => 'H6', 'description' => 'This is Block H6', 'sequence' => 6],
            ['name' => 'H7', 'description' => 'This is Block H7', 'sequence' => 7],
            ['name' => 'H8', 'description' => 'This is Block H8', 'sequence' => 8]
        ]);
    }
}
