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

    public function image()
    {
        return $this->state(function (array $attributes) {
            return [
                'extension' => 'jpg',
                'duration'  => NULL,
                'path'      => $this->getTestMediaPath('image'),
                'type'      => 'image',
            ];
        });
    }

    public function video()
    {
        return $this->state(function (array $attributes) {
            return [
                'extension' => 'mp4',
                'duration'  => rand(1000, 20000),
                'path'      => $this->getTestMediaPath('video'),
                'type'      => 'video',
            ];
        });
    }

    private function getTestMediaPath(string $type): string
    {
        $amount_of_test_images = 3;
        $amount_of_test_videos = 2;

        $number = ($type === 'image') ? mt_rand(1, $amount_of_test_images) : mt_rand(1, $amount_of_test_videos);

        return "medias/tests/{$type}_test_{$number}.jpg";
    }
}
