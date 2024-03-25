<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Multimedia>
 */
class MultimediaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            //
            'name'              => fake()->name(),
            'path'              => fake()->imageUrl(),
            'text_alternative'  => fake()->text(30),
            'mimetype'          => 'image/gif'
        ];
    }
}
