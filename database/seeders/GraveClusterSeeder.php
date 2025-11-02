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
            ['name' => 'A', 'description' => 'Block A', 'sequence' => 1],
            ['name' => 'B', 'description' => 'Block B', 'sequence' => 2],
            ['name' => 'C', 'description' => 'Block C', 'sequence' => 3],
            ['name' => 'D', 'description' => 'Block D', 'sequence' => 4],
            ['name' => 'E', 'description' => 'Block E', 'sequence' => 5],
            ['name' => 'F', 'description' => 'Block F', 'sequence' => 6],
            ['name' => 'G', 'description' => 'Block G', 'sequence' => 7],
            ['name' => 'H', 'description' => 'Block H', 'sequence' => 8]
        ]);

        GraveCluster::create([
            'site_id' => 1,
            'name' => 'Adn',
            'description' => 'This is Cluster Adn',
            'sequence' => 2,
        ])->blocks()->createMany([
            ['name' => 'A', 'description' => 'Block A', 'sequence' => 1],
            ['name' => 'B', 'description' => 'Block B', 'sequence' => 2],
            ['name' => 'C', 'description' => 'Block C', 'sequence' => 3],
            ['name' => 'D', 'description' => 'Block D', 'sequence' => 4],
            ['name' => 'E', 'description' => 'Block E', 'sequence' => 5],
            ['name' => 'F', 'description' => 'Block F', 'sequence' => 6],
            ['name' => 'G', 'description' => 'Block G', 'sequence' => 7],
            ['name' => 'H', 'description' => 'Block H', 'sequence' => 8]
        ]);

        GraveCluster::create([
            'site_id' => 1,
            'name' => "Na'im",
            'description' => "This is Cluster Na'im",
            'sequence' => 3,
        ])->blocks()->createMany([
            ['name' => 'A', 'description' => 'Block A', 'sequence' => 1],
            ['name' => 'B', 'description' => 'Block B', 'sequence' => 2],
            ['name' => 'C', 'description' => 'Block C', 'sequence' => 3],
            ['name' => 'D', 'description' => 'Block D', 'sequence' => 4],
            ['name' => 'E', 'description' => 'Block E', 'sequence' => 5],
            ['name' => 'F', 'description' => 'Block F', 'sequence' => 6],
            ['name' => 'G', 'description' => 'Block G', 'sequence' => 7],
            ['name' => 'H', 'description' => 'Block H', 'sequence' => 8]
        ]);

        GraveCluster::create([
            'site_id' => 1,
            'name' => "Ma'wa",
            'description' => "This is Cluster Ma'wa",
            'sequence' => 4,
        ])->blocks()->createMany([
            ['name' => 'A', 'description' => 'Block A', 'sequence' => 1],
            ['name' => 'B', 'description' => 'Block B', 'sequence' => 2],
            ['name' => 'C', 'description' => 'Block C', 'sequence' => 3],
            ['name' => 'D', 'description' => 'Block D', 'sequence' => 4],
            ['name' => 'E', 'description' => 'Block E', 'sequence' => 5],
            ['name' => 'F', 'description' => 'Block F', 'sequence' => 6],
            ['name' => 'G', 'description' => 'Block G', 'sequence' => 7],
            ['name' => 'H', 'description' => 'Block H', 'sequence' => 8]
        ]);

        GraveCluster::create([
            'site_id' => 1,
            'name' => 'Darussalam',
            'description' => "This is Cluster Darussalam",
            'sequence' => 5,
        ])->blocks()->createMany([
            ['name' => 'A', 'description' => 'Block A', 'sequence' => 1],
            ['name' => 'B', 'description' => 'Block B', 'sequence' => 2],
            ['name' => 'C', 'description' => 'Block C', 'sequence' => 3],
            ['name' => 'D', 'description' => 'Block D', 'sequence' => 4],
            ['name' => 'E', 'description' => 'Block E', 'sequence' => 5],
            ['name' => 'F', 'description' => 'Block F', 'sequence' => 6],
            ['name' => 'G', 'description' => 'Block G', 'sequence' => 7],
            ['name' => 'H', 'description' => 'Block H', 'sequence' => 8]
        ]);

        GraveCluster::create([
            'site_id' => 1,
            'name' => 'Darul Muqamah',
            'description' => "This is Cluster Darul Muqamah",
            'sequence' => 6,
        ])->blocks()->createMany([
            ['name' => 'A', 'description' => 'Block A', 'sequence' => 1],
            ['name' => 'B', 'description' => 'Block B', 'sequence' => 2],
            ['name' => 'C', 'description' => 'Block C', 'sequence' => 3],
            ['name' => 'D', 'description' => 'Block D', 'sequence' => 4],
            ['name' => 'E', 'description' => 'Block E', 'sequence' => 5],
            ['name' => 'F', 'description' => 'Block F', 'sequence' => 6],
            ['name' => 'G', 'description' => 'Block G', 'sequence' => 7],
            ['name' => 'H', 'description' => 'Block H', 'sequence' => 8]
        ]);

        GraveCluster::create([
            'site_id' => 1,
            'name' => 'Maqamul Amin',
            'description' => "This is Cluster Maqamul Amin",
            'sequence' => 7,
        ])->blocks()->createMany([
            ['name' => 'A', 'description' => 'Block A', 'sequence' => 1],
            ['name' => 'B', 'description' => 'Block B', 'sequence' => 2],
            ['name' => 'C', 'description' => 'Block C', 'sequence' => 3],
            ['name' => 'D', 'description' => 'Block D', 'sequence' => 4],
            ['name' => 'E', 'description' => 'Block E', 'sequence' => 5],
            ['name' => 'F', 'description' => 'Block F', 'sequence' => 6],
            ['name' => 'G', 'description' => 'Block G', 'sequence' => 7],
            ['name' => 'H', 'description' => 'Block H', 'sequence' => 8]
        ]);

        GraveCluster::create([
            'site_id' => 1,
            'name' => 'Khuldi',
            'description' => "This is Cluster Khuldi",
            'sequence' => 8,
        ])->blocks()->createMany([
            ['name' => 'A', 'description' => 'Block A', 'sequence' => 1],
            ['name' => 'B', 'description' => 'Block B', 'sequence' => 2],
            ['name' => 'C', 'description' => 'Block C', 'sequence' => 3],
            ['name' => 'D', 'description' => 'Block D', 'sequence' => 4],
            ['name' => 'E', 'description' => 'Block E', 'sequence' => 5],
            ['name' => 'F', 'description' => 'Block F', 'sequence' => 6],
            ['name' => 'G', 'description' => 'Block G', 'sequence' => 7],
            ['name' => 'H', 'description' => 'Block H', 'sequence' => 8]
        ]);
    }
}
