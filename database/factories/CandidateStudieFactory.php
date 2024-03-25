<?php

namespace Database\Factories;

use App\Models\CandidateStudie;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;

/**
 * @extends Factory<CandidateStudie>
 */
class CandidateStudieFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id'           => 5,
            'multimedia_id'     => 1,
            'name'              => fake()->name(),
            'description'       => fake()->text(220),
            'start_date'        => fake()->dateTime(),
            'finish_date'       => fake()->dateTime()
        ];
    }
}
