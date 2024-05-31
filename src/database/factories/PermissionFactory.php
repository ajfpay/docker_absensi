<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Permissio>
 */
class PermissionFactory extends Factory
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
            'user_id' => 11,
            'date_permission' => $this->faker->date('Y-m-d'),
            'reason' => $this->faker->text(200),
            'image' => $this->faker->imageUrl(),
            'is_approved' => $this->faker->boolean(),

        ];
    }
}