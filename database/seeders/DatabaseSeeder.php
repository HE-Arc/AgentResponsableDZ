<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\User::factory(10)->create();
        \App\Models\Plane::factory(3)->create();
        \App\Models\Flight::factory(5)->create();

        foreach(\App\Models\Flight::all() as $f){
            $users = \App\Models\User::inRandomOrder()->take(rand(5,10))->pluck("id");
            $f->users()->attach($users);
        }
        /*$flights = \App\Models\Flight::all();
        foreach(\App\Models\User::all() as $u){
            $flights[rand(0,count($flights))]->attach($u);
            $flights[rand(0,count($flights))]->attach($u);
            $flights[rand(0,count($flights))]->attach($u);
        }*/
    }
}
