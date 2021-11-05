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
            'description' => $this->faker->text(rand(5, 50)),
            'isoweekday'  => rand(1, 7),
            'day'         => rand(1, 31),
            'month'       => rand(1, 12),
            'year'        => rand(2021, 2025),              
        ];
    }
}
