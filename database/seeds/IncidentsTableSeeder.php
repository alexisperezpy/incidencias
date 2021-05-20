<?php

use App\Incident;
use Illuminate\Database\Seeder;

class IncidentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Incident::create([
            'title'=>'Primera incidencia creada',
            'description'=>'Esta incidencia fue creada automaticamente',
            'severity'=>'A',
            'category_id'=>'2',
            'project_id'=>1,
            'level_id'=>1,
            'client_id'=>2,
            'support_id'=>3
        ]);
    }
}
