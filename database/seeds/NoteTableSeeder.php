<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\Project;
use App\Note;

/**
* NoteTableSeeder
*/
class NoteTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        $project_all = Project::lists('id');
        $project_ids = [];

        foreach ($project_all as $index) {
            $project_ids[] = $project_all[$index - 1];
        }

        // dd($project_ids);

        foreach (range(1, 100) as $index) {
            Note::create([
                'project_id' => $faker->randomElement($project_ids),
                'title' => $faker->sentence(6),
                'description' => $faker->paragraph(4),
                'stamp' => $faker->dateTime->format('d/m/Y')
            ]);
        }
    }
}
