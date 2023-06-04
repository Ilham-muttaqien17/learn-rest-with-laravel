<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::truncate();
        
        $faker = \Faker\Factory::create();

        $password = Hash::make('dev');

        User::create([
            'name' => 'Admin Guanteng',
            'email' => 'admin@gmail.com',
            'password' => $password
        ]);

        for($i = 0; $i < 5; $i++) {
            User::create([
                'name' => $faker->name(),
                'email' => $faker->email(),
                'password' => $password,
            ]);
        }

    }
}
