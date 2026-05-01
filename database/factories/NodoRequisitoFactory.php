<?php

namespace Database\Factories;

use App\Models\NodoRequisito;
use App\Models\SituacionCompetencia;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<NodoRequisito>
 */
class NodoRequisitoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'situacion_competencia_id' => SituacionCompetencia::factory(),
            'tipo' => $this->faker->randomElement(['conocimiento', 'habilidad']),
            'descripcion' => $this->faker->sentence(),
            'orden' => $this->faker->numberBetween(1, 10),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
