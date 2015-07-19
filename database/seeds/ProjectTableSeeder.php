<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\Status;
use App\Project;

/**
* ProjectTableSeeder
*/
class ProjectTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        $status_all = Status::lists('id');
        $status_ids = [];

        foreach ($status_all as $index) {
            $status_ids[] = $status_all[$index - 1];
        }

        // dd($status_ids);

        foreach (range(1, 40) as $index) {
            Project::create([
                'status_id' => $faker->randomElement($status_ids),
                'name' => $faker->unique()->sentence(6),
                'description' => $faker->paragraph(4),
                'repository' => $faker->url(),
                'url' => $faker->url(),
                'is_active' => $faker->randomElement([true, false])
            ]);
        }
    }
}
