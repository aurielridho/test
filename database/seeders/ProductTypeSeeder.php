<?php

namespace Database\Seeders;

use App\Models\ProductType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ProductType::query()->insert([
            [
                'id' => 'd617bb00-ff6e-4353-b89c-f140a766de75',
                'name' => 'Woodwork',
                'created_at' => now()
            ],
            [
                'id'=> 'ea4fc871-2d92-4acc-a400-75d104a86b79',
                'name' => 'Pottery',
                'created_at' => now()

            ],
            [
                'id' => '7b4eb46d-972b-4cd5-85c3-6d9857395a55',
                'name' => 'Textile',
                'created_at' => now()
            ],
            [
                'id' => 'f3498e22-a899-432d-bac4-6abeed0ede04',
                'name' => 'Metalwork',
                'created_at' => now()
            ],
            [
                'id' => '8e0f3fb0-9fcb-4b57-868b-da575dd61512',
                'name' => 'Bamboo',
                'created_at' => now()
            ]
        ]);
    }
}
