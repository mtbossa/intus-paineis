<?php

namespace Database\Factories;

use App\Models\Display;
use Illuminate\Database\Eloquent\Factories\Factory;

class DisplayFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Display::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name'     => $this->faker->text(rand(5, 50)),
            'location' => $this->generateLocation(),
        ];
    }

    private function generateLocation()
    {
        $city = $this->faker->city();
        $state = $this->faker->state();
        $street = $this->faker->streetAddress();

        return "$street - $city, $state";
    }
}
