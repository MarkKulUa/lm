<?php

use Illuminate\Database\Seeder;

class ProductsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $products = [
            [
                'name' => 'Item One',
                'description' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Amet numquam aspernatur!',
                'price' => 24.99,
                'units' => 88,
                'photo' => '/images/700x400.png',

            ],
            [
                'name' => 'Item Two',
                'description' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Amet numquam aspernatur! Lorem ipsum dolor sit amet.',
                'price' => 24.99,
                'units' => 19,
                'photo' => '/images/700x400.png',

            ],
            [
                'name' => 'Item Three',
                'description' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Amet numquam aspernatur!',
                'price' => 24.99,
                'units' => 50,
                'photo' => '/images/700x400.png',

            ],
            [
                'name' => 'Item Four',
                'description' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Amet numquam aspernatur! Lorem ipsum dolor sit amet.',
                'price' => 24.99,
                'units' => 20,
                'photo' => '/images/700x400.png',

            ],
            [
                'name' => 'Item Five',
                'description' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Amet numquam aspernatur!',
                'price' => 24.99,
                'units' => 100,
                'photo' => '/images/700x400.png',

            ],
            [
                'name' => 'Item Six',
                'description' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Amet numquam aspernatur! Lorem ipsum dolor sit amet.',
                'price' => 24.99,
                'units' => 10,
                'photo' => '/images/700x400.png',

            ],
        ];

        foreach ($products as $product) {
            \App\Models\Product::create($product);
        }
    }
}
