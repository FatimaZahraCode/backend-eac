<?php

namespace Database\Factories;

use App\Models\Modulo;
use App\Models\ResultadoAprendizaje;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<ResultadoAprendizaje>
 */
class ResultadoAprendizajeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'modulo_id' => Modulo::factory(),
            'codigo' => 'RA' . $this->faker->unique()->numberBetween(1, 99), // Genera códigos como "RA1", "RA2", etc.
            'descripcion' => $this->faker->sentence(),
            'peso_porcentaje' => $this->faker->randomElement([25, 30, 35, 40]),
            //'orden'           => $this->faker->numberBetween(1, 10),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
