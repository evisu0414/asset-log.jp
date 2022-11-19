<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\FuneralCompany;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<FuneralCompany>
 */
class FuneralCompanyFactory extends Factory
{
    /**
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'squid_id' => fake()->unique()->randomNumber(),
            'name' => fake()->company(),
        ];
    }
}
