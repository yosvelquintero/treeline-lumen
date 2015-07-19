<?php

use Faker\Factory as Faker;
use Illuminate\Database\Seeder;
use App\User;

/**
* UserTableSeeder
*/
class UserTableSeeder extends Seeder
{

    public function run()
    {
        $faker = Faker::create();

        foreach (range(1, 30) as $index) {
            User::create([
                'name' => $faker->name(),
                'email' => $faker->email(),
                'password' => bcrypt('allcontrol')
            ]);
        }
    }
}
