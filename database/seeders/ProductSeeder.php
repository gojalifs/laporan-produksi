<?php

namespace Database\Seeders;

use App\Models\ProductionModel;
use App\Models\ProductModel;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $products = [
            ['id' => '1', 'code' => 'D30', 'name' => 'Pipe Inner', 'created_at' => '2023-11-21 09:35:45', 'updated_at' => '2023-11-21 09:35:45'],
            ['id' => '2', 'code' => 'D55', 'name' => 'Pipe Inner', 'created_at' => '2023-11-21 09:35:45', 'updated_at' => '2023-11-21 09:35:45'],
        ];
        foreach ($products as $product) {
            ProductModel::create($product);
        }
    }
}
