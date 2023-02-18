<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class EventFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title' => $this->faker->title,
            'description' => $this->faker->paragraph,
            'image' => $this->faker->imageUrl,
            'ubication' => $this->faker->latitude,
            'date' => $this->faker->date(),
            'hour' => $this->faker->time(),
            'id_author' => User::factory(),
        ];
    }
}
