<?php

use App\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //User Admin
        User::create([
            'name'=>'Alexis Pérez',
            'email'=>'ale@ale.com',
            'password'=>bcrypt('lapichu'),
            'role'=>0
        ]);

        
        //User Client
        User::create([
            'name'=>'Cliente Quejón',
            'email'=>'cliente@ale.com',
            'password'=>bcrypt('lapichu'),
            'role'=>2
        ]);


    }
}
