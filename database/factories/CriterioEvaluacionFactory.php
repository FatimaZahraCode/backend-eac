<?php

namespace Database\Factories;

use App\Models\CriterioEvaluacion;
use App\Models\ResultadoAprendizaje;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<CriterioEvaluacion>
 */
class CriterioEvaluacionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'resultado_aprendizaje_id' => ResultadoAprendizaje::factory(),
            'codigo' =>'CE' . $this->faker->unique()->bothify('#?'), // Genera códigos como "CE1A", "CE2B", etc.
            'descripcion' => $this->faker->sentence(),
            'peso_porcentaje'          => $this->faker->randomElement([20, 25, 30, 50]),
            //'orden'                    => $this->faker->numberBetween(1, 10),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
