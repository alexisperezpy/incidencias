<?php

use App\Project;
use Illuminate\Database\Seeder;

class ProjectsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Project::create([
            'name'=>'Proyecto A',
            'description'=>'El proyecto consiste en desarrollar un Sitio Web Responsivo.'
        ]);
            
        Project::create([
            'name'=>'Proyecto B',
            'description'=>'El proyecto consiste en desarrollar una Aplicación Móvil.'
        ]);
    }
}
