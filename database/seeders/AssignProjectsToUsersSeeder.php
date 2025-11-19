<?php

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Project;

class AssignProjectsToUsersSeeder extends Seeder
{
    public function run(): void
    {
        // Obtener todos los usuarios y proyectos existentes
        $users = User::all();
        $projects = Project::all();

        // Si no hay registros, evitamos errores
        if ($users->count() === 0 || $projects->count() === 0) {
            $this->command->warn("No hay usuarios o proyectos en la base de datos.");
            return;
        }

        // Asignar proyectos a cada usuario
        foreach ($users as $user) {
            // Selecciona entre 1 y 3 proyectos aleatorios
            $projectIds = $projects->random(rand(1, min(2, $projects->count())))->pluck('id');

            // Insertar en la tabla pivote
            $user->project()->syncWithoutDetaching($projectIds);
        }

        $this->command->info("Proyectos asignados correctamente.");
    }
}
