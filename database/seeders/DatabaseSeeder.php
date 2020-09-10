<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
//        $this->call('App\database\seeders\ProductsSeeder');
//        $this->call('ProductsSeeder');

        $products = [
            [
                'name' => 'Item One',
                'description' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Amet numquam aspernatur!',
                'price' => 21.05,
                'photo' => '/images/700x400.png',

            ],
            [
                'name' => 'Item Two',
                'description' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Amet numquam aspernatur! Lorem ipsum dolor sit amet.',
                'price' => 4.99,
                'photo' => '/images/700x400.png',

            ],
            [
                'name' => 'Item Three',
                'description' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Amet numquam aspernatur!',
                'price' => 55.09,
                'photo' => '/images/700x400.png',

            ],
            [
                'name' => 'Item Four',
                'description' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Amet numquam aspernatur! Lorem ipsum dolor sit amet.',
                'price' => 15.49,
                'photo' => '/images/700x400.png',

            ],
            [
                'name' => 'Item Five',
                'description' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Amet numquam aspernatur!',
                'price' => 105.89,
                'photo' => '/images/700x400.png',

            ],
            [
                'name' => 'Item Six',
                'description' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Amet numquam aspernatur! Lorem ipsum dolor sit amet.',
                'price' => 240.19,
                'photo' => '/images/700x400.png',

            ],
        ];

        foreach ($products as $product) {
            \App\Models\Product::create($product);
        }

        \App\Models\User::firstOrCreate([
                                'email' => "admin@devtest.com"
                            ], [
                                'name' =>'Admin',
                                'password' => bcrypt('secret'),
                                'is_admin' => true
                            ]);
    }
}
