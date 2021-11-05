<?php

namespace Database\Factories;

use App\Models\Media;
use Illuminate\Database\Eloquent\Factories\Factory;

class MediaFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Media::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name'        => $this->faker->text(rand(5, 50)),
            'description' => $this->faker->text(rand(5, 100)),
        ];
    }

    public function jpeg_image()
    {
        return $this->state(function (array $attributes) {
            return [
                'extension' => 'jpeg',
                'duration' => NULL,
                'path'      => 'teste',
                'type'      => 'image/jpeg',
            ];
        });
    }

    public function png_image()
    {
        return $this->state(function (array $attributes) {
            return [
                'extension' => 'png',
                'duration' => NULL,
                'path'      => 'teste',
                'type'      => 'image/png',
            ];
        });
    }

    public function mp4_video()
    {
        return $this->state(function (array $attributes) {
            return [
                'extension' => 'mp4',
                'duration' =>   rand(1000, 20000),
                'path'      => 'teste',
                'type'      => 'video/mp4',
            ];
        });
    }
}
