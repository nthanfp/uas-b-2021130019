<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ItemsTableSeeder extends Seeder
{
    public function run()
    {
        // Clear existing data in the table
        DB::table('items')->truncate();

        // Generate and insert sample data
        $items = [
            [
                'id' => '1234567890123456',
                'nama' => 'Item 1',
                'harga' => 10.99,
                'stok' => 100,
            ],
            [
                'id' => '9876543210987654',
                'nama' => 'Item 2',
                'harga' => 19.99,
                'stok' => 50,
            ],
            // Add more items as needed
        ];

        DB::table('items')->insert($items);
    }
}
