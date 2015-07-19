<?php

use Faker\Factory as Faker;
use Illuminate\Database\Seeder;
use App\Status;

/**
* StatusTableSeeder
*/
class StatusTableSeeder extends Seeder
{

    public function run()
    {
        // $pending = ['name' => 'Pending'];
        // $doing = ['name' => 'Doing'];
        // $completed = ['name' => 'Completed'];

        // Status::create($pending);
        // Status::create($doing);
        // Status::create($completed);

        $faker = Faker::create();

        foreach (range(1, 3) as $index) {
            Status::create([
                'name' => $faker->sentence(2)
            ]);
        }
    }
}
