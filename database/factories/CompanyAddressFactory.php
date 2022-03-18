<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\CompanyAddress>
 */
class CompanyAddressFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            "company_id" => $this->faker->randomDigitNotNull(),
            "address_line_1" => $this->faker->address(),
            "address_line_2" => $this->faker->streetAddress(),
            "city" => $this->faker->city(),
            "parish" => $this->faker->country(),
        ];
    }
}
