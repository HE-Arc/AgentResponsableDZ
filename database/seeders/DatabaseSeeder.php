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
        // insert root user
        \Illuminate\Support\Facades\DB::table('users')->insert([
            'name' => 'root',
            'surname' => 'sroot',
            'email' => 'root@example.com',
            'phone_number' => '1234567890',
            'password' => bcrypt('IAmRoot'),
            'is_RDZ' => true,
            'credits4000' => 40,
            'credits1500' => 20,
        ]);

        // insert lambda user
        \Illuminate\Support\Facades\DB::table('users')->insert([
            'name' => 'alphabet',
            'surname' => 'albedo',
            'email' => 'al@pha.bet',
            'phone_number' => '0987654321',
            'password' => bcrypt('abcdefg'),
            'is_RDZ' => false,
        ]);

        \App\Models\User::factory(5)->create();

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
