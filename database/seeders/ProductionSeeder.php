<?php

namespace Database\Seeders;

use App\Models\ProductionModel;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $productions = [
            ['id' => '1', 'product_id' => '1', 'lot_number' => '2024-01-30', 'user_id' => '1', 'departemen' => 'Production', 'bagian' => 'Press Welding', 'status' => 'OK', 'created_at' => '2023-11-20 09:35:54', 'updated_at' => '2023-11-21 09:35:54'],
            ['id' => '2', 'product_id' => '1', 'lot_number' => '2024-01-30', 'user_id' => '1', 'departemen' => 'Production', 'bagian' => 'Press Welding', 'status' => 'OK', 'created_at' => '2023-11-21 09:46:51', 'updated_at' => '2023-11-21 09:46:51'],
            ['id' => '3', 'product_id' => '2', 'lot_number' => '2024-01-30', 'user_id' => '1', 'departemen' => 'Production', 'bagian' => 'Press Welding', 'status' => 'OK', 'created_at' => '2023-11-17 09:48:47', 'updated_at' => '2023-11-21 09:48:47'],
            ['id' => '4', 'product_id' => '2', 'lot_number' => '2024-01-31', 'user_id' => '1', 'departemen' => 'Production', 'bagian' => 'Press Welding', 'status' => 'OK', 'created_at' => '2023-11-21 09:49:31', 'updated_at' => '2023-11-21 09:49:31'],
        ];

        foreach ($productions as $production) {
            ProductionModel::create($production);
        }
    }
}
