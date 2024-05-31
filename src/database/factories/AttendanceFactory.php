<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Attendance>
 */
class AttendanceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            //create data dummy
            'user_id' => fake()->numberBetween(1, 10),
            'date' => fake()->date(),
            'time_in' => fake()->time(),
            'time_out' => fake()->time(),
            'latlon_in' => fake()->latitude() . ',' . fake()->longitude(),
            'latlon_out' => fake()->latitude(). ',' . fake()->longitude(),
        ];
    }
}
