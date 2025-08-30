<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\MasterPaymentMethod;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class MasterPaymentMethodSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $paymentMethods = [
            ['name' => 'Cash'],
            ['name' => 'Bank Transfer'],
            ['name' => 'PayPal']
        ];

        foreach ($paymentMethods as $method) {
            MasterPaymentMethod::create($method);
        }
    }
}
