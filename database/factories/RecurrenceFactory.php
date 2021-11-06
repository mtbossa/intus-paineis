<?php

namespace Database\Factories;

use App\Models\Recurrence;
use Illuminate\Database\Eloquent\Factories\Factory;

class RecurrenceFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Recurrence::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'description' => $this->faker->text(rand(5, 30)),
            'isoweekday'  => $this->faker->boolean(50) ? rand(1, 7) : null, 
            'day'         => $this->faker->boolean(50) ? rand(1, 31) : null,
            'month'       => $this->faker->boolean(50) ? rand(1, 12) : null,
            'year'        => $this->faker->boolean(50) ? rand(2021, 2025) : null,              
        ];
    }
}
