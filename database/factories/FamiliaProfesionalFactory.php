<?php

namespace Database\Factories;

use App\Models\FamiliaProfesional;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<FamiliaProfesional>
 */
class FamiliaProfesionalFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nombre' => $this->faker->word(),
            'codigo' => $this->faker->unique()->regexify('[A-Z]{3}'),
            'descripcion' => $this->faker->sentence(),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
