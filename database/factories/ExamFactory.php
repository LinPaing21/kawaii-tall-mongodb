<?php

namespace Database\Factories;

use Illuminate\Support\Arr;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Exam>
 */
class ExamFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $level = Arr::random(["N1", "N2", "N3", "N4", "N5"]);
        $year = fake()->dateTime();

        return [
            "name" => "{$level} - {$year->format('F Y')}",
            "level" => $level,
            "description" => fake()->sentences(2, true),
            "year" => $year,
        ];
    }
}
