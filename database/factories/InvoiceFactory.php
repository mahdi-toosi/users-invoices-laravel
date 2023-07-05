<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class InvoiceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name' => 'Invoice '.$this->faker->numberBetween(1, 100),
            'year' => $this->faker->numberBetween(1401, 1403),
            'month' => $this->faker->numberBetween(1, 12),
        ];
    }
}
