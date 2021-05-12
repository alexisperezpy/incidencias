<?php

use App\Level;
use Illuminate\Database\Seeder;

class LevelsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Level::create([
            'name' => 'Atención remota',
            'project_id' => '1',            
        ]);
    
        Level::create([
            'name' => 'Atención on-line',
            'project_id' => '1',
        ]);

        Level::create([
            'name' => 'Visita técnica',
            'project_id' => '1',
        ]);

        Level::create([
            'name' => 'Mesa de ayuda',
            'project_id' => '2',
        ]);

        Level::create([
            'name' => 'Consulta especializada',
            'project_id' => '2',
        ]);

    }
}
