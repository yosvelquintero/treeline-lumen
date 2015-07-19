<?php
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use App\Status;
use App\Project;
use App\Note;
use App\Link;
use App\User;

/**
* DatabaseSeeder
*/
class DatabaseSeeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->dbTablesTruncate();

        Model::unguard();

        // $this->call('UserTableSeeder');
        $this->call('StatusTableSeeder');
        $this->call('ProjectTableSeeder');
        $this->call('NoteTableSeeder');
        $this->call('LinkTableSeeder');
        $this->call('UserTableSeeder');
    }

    public function dbTablesTruncate()
    {
        // Truncate
        DB::statement('SET FOREIGN_KEY_CHECKS=0');
        Status::truncate();
        Project::truncate();
        Note::truncate();
        Link::truncate();
        User::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1');
    }
}
