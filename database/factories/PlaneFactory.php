<?php

namespace Database\Factories;

use App\Models\Plane;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class PlaneFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Plane::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $reg = "HB-".strtoupper(Str::random(3));
        /*$reg = "HB-".$this->$faker->randomLetter().$this->$faker->randomLetter().$this->$faker->randomLetter();//HB-AVC
        return [
            'model' => $this->faker->firstNameFemale(),
            'registration' => $reg, 
            'seat_count'=> $this->$faker->numberBetween(8, 15),
            'picture'=> "./".$reg,
        ];*/
        return [
            'model' =>  $this->faker->firstNameFemale(),
            'registration' =>  $reg, 
            'seat_count'=> rand(8,15),
            'picture'=> "./$reg.png",
        ];
    }
}
