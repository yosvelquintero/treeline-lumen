<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\Note;
use App\Link;

/**
* LinkTableSeeder
*/
class LinkTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        $note_all = Note::lists('id');
        $note_ids = [];

        foreach ($note_all as $index) {
            $note_ids[] = $note_all[$index - 1];
        }

        foreach (range(1, 80) as $index) {
            Link::create([
                'note_id' => $faker->randomElement($note_ids),
                'name' => $faker->sentence(5),
                'href' => $faker->url()
            ]);
        }
    }
}
