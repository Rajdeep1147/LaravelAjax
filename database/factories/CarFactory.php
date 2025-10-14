<?php

namespace Database\Factories;

use App\Models\Car;
use App\Models\Machanic;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Car>
 */
class CarFactory extends Factory
{
    protected $model = Car::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
           'model' => $this->faker->word(),
           'machanic_id' => Machanic::factory(),
        ];
    }
}
