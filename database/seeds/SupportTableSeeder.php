<?php

use App\User;
use Illuminate\Database\Seeder;

class SupportTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ///User Support
        User::create([
            'name' => 'Soporte S1',
            'email' => 'soporte1@ale.com',
            'password' => bcrypt('123456'),
            'role' => 1
        ]);
        //User Support
        User::create([
            'name' => 'Soporte S2',
            'email' => 'soporte2@ale.com',
            'password' => bcrypt('123456'),
            'role' => 1
        ]);
    }
}
