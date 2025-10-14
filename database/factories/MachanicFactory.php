<?php

namespace Database\Factories;

use App\Models\Machanic;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Machanic>
 */
class MachanicFactory extends Factory
{
    protected $model = Machanic::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
          'name' => $this->faker->name(),
          'phone' => $this->faker->phoneNumber(),


        ];
    }
}
