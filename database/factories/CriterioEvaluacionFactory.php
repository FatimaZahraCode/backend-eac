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
            'codigo' => $this->faker->bothify('CE#'),
            'descripcion' => $this->faker->sentence(),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
