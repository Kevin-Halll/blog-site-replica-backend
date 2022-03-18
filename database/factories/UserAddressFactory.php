<?php

namespace Database\Factories;

use App\Models\User;
use \Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\UserAddress>
 */
class UserAddressFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            "user_id" => $this->faker->randomElement(DB::table('users')->pluck('id')),
            "address_line_1" => $this->faker->address(),
            "address_line_2" => $this->faker->streetAddress(),
            "city" => $this->faker->city(),
            "parish" => $this->faker->country(),
        ];
    }
}
