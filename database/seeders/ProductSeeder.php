<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
    
        Product::insert([
            [
                'name' => 'Impex TV',
                'price' => 10107.99,
                'stock_quantity' => 20,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Sony TV',
                'price' => 2546.00,
                'stock_quantity' => 15,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'BPL TV',
                'price' => 4856.00,
                'stock_quantity' => 10,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'HP Laptop',
                'price' => 7822.00,
                'stock_quantity' => 50,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Dell Laptop',
                'price' => 8452.00,
                'stock_quantity' => 12,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Nokia Mobile',
                'price' => 5007.00,
                'stock_quantity' => 12,
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);
    }
}
