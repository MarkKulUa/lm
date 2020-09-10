<?php

use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    public function run()
    {
        \App\Models\User::firstOrCreate([
                                'email' => "admin@devtest.com"
                            ], [
                                'name' =>'Admin',
                                'password' => bcrypt('secret'),
                                'is_admin' => true
                            ]);
    }
}
