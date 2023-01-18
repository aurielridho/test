<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\ProductType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Faker;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Product::query()->insert([
            [
                'id' => Str::uuid(),
                'name' => 'Dragon Isle',
                'description' => 'Made from Walnut, Cedar, and Maplez',
                'product_type_id' => 'd617bb00-ff6e-4353-b89c-f140a766de75',
                'price' => 2599,
                'stock' => 1,
                'image_url' => 'Product/1.jpg',
                'created_at' => now()
            ],
            [
                'id' => Str::uuid(),
                'name' => '7 String Custom Guitar',
                'description' => 'Consist of Ash Wings, Bubinga Rails, and Rock Maple',
                'product_type_id' => 'd617bb00-ff6e-4353-b89c-f140a766de75',
                'price' => 800,
                'stock' => 5,
                'image_url' => 'Product/2.jpg',
                'created_at' => now()
            ],
            [
                'id' => Str::uuid(),
                'name' => 'The Fight',
                'description' => 'Carved from Walnut Wood, made for endless imaginations.',
                'product_type_id' => 'd617bb00-ff6e-4353-b89c-f140a766de75',
                'price' => 1200,
                'stock' => 3,
                'image_url' => 'Product/3.jpg',
                'created_at' => now()
            ],
            [
                'id' => Str::uuid(),
                'name' => 'The Chipmunk',
                'description' => 'A 60 Hour of Work, Created from a Basswood Tupelo.',
                'product_type_id' => 'd617bb00-ff6e-4353-b89c-f140a766de75',
                'price' => 721,
                'stock' => 1,
                'image_url' => 'Product/4.jpg',
                'created_at' => now()
            ],
            [
                'id' => Str::uuid(),
                'name' => 'Bunch Shaped Vase',
                'description' => 'Just Another Flower Vase.',
                'product_type_id' => 'ea4fc871-2d92-4acc-a400-75d104a86b79',
                'price' => 230,
                'stock' => 8,
                'image_url' => 'Product/5.jpg',
                'created_at' => now()
            ],
            [
                'id' => Str::uuid(),
                'name' => 'Full Set Terrafirma Vase',
                'description' => 'Just Another Flower Vase.',
                'product_type_id' => 'ea4fc871-2d92-4acc-a400-75d104a86b79',
                'price' => 1840,
                'stock' => 2,
                'image_url' => 'Product/6.jpg',
                'created_at' => now()
            ],
            [
                'id' => Str::uuid(),
                'name' => 'Sprout 5 in Lichen Verdigris Glaze',
                'description' => 'Homemade Rustic Decor suited for Classic Home Decoration',
                'product_type_id' => 'ea4fc871-2d92-4acc-a400-75d104a86b79',
                'price' => 525,
                'stock' => 4,
                'image_url' => 'Product/7.jpg',
                'created_at' => now()
            ],
            [
                'id' => Str::uuid(),
                'name' => 'Grueby Vase',
                'description' => 'Emerald Green Vase with Classic Touch',
                'product_type_id' => 'ea4fc871-2d92-4acc-a400-75d104a86b79',
                'price' => 120,
                'stock' => 14,
                'image_url' => 'Product/8.jpg',
                'created_at' => now()
            ],
        ]);
        $faker = Faker\Factory::create('en_GB');
        $fk = ProductType::all()->pluck('id')->toArray();
        for($i=1;$i<=15;$i++){
            Product::query()->insert([
                'id' => Str::uuid(),
                'name' => $faker->words(2, true),
                'description' => $faker->words(7, true),
                'product_type_id' => $fk[random_int(0, sizeof($fk)-1)],
                'price' => $faker->numberBetween(100,2000),
                'stock' => $faker->numberBetween(1, 20),
                'image_url' => 'Product/'.$i+8 .'.jpg',
                'created_at' => now()
            ]);
        }
    }
}
