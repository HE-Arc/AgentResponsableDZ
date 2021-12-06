<?php

namespace Database\Factories;

use App\Models\Flight;
use Illuminate\Database\Eloquent\Factories\Factory;
use Carbon\Carbon;

class FlightFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Flight::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'plane_id'=> rand(1,3), //Carefull to create 3 planes first. Might be dangerous but idk how to do it right
            'departure' => Carbon::now(),
        ];
    }
}
