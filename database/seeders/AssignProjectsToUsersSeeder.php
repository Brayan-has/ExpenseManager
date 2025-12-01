<?php

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Project;

class AssignProjectsToUsersSeeder extends Seeder
{
    public function run(): void
    {
        // get the users and the projects
        $users = User::all();
        $projects = Project::all();

        // If theres's no registers show a worning
        if ($users->count() === 0 || $projects->count() === 0) {
            $this->command->warn("There are not projects and users in the database.");
            return;
        }

        // Asign project to every user
        foreach ($users as $user) {
            // Select between 1 and 3 random projects
            $projectIds = $projects->random(rand(1, min(2, $projects->count())))->pluck('id');

            // Insert into the privote project table
            $user->project()->syncWithoutDetaching($projectIds);
        }

        $this->command->info("Project assigned correctly.");
    }
}
