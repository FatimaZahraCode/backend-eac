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
            'codigo' => $this->faker->bothify('RA#'), // Genera códigos como "RA1", "RA2", etc.
            'descripcion' => $this->faker->sentence(),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
