<?php

namespace Database\Factories;

use App\Models\CicloFormativo;
use App\Models\Modulo;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Modulo>
 */
class ModuloFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'ciclo_formativo_id' => CicloFormativo::factory(),
            'nombre' => $this->faker->word(),
            'codigo' => $this->faker->unique()->regexify('[0-9]{20}'),
            'horas_totales' => $this->faker->numberBetween(0, 100),
            'descripcion' => $this->faker->sentence(),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
