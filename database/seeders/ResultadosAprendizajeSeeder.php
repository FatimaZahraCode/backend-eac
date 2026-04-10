<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ResultadosAprendizajeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $path = database_path('seeders/csv/resultados_aprendizaje.csv');

        if (!file_exists($path)) {
            $this->command->error("CSV no encontrado: $path");
            return;
        }

        // Leer todas las líneas y parsear con str_getcsv
        $rows = array_map('str_getcsv', file($path));

        // El primer registro es la cabecera
        $header = array_map('trim', array_shift($rows));
        $modulo_id = DB::table('modulos')->pluck('id', 'codigo');
        $data = [];
        foreach ($rows as $row) {
            // Ignorar filas vacías o mal formadas
            if (count($row) < count($header)) {
                continue;
            }

            $rec = array_combine($header, $row);

            $data[] = [
                'modulo_id' => trim($modulo_id[trim($rec['cod_modulo'] ?? '')] ?? null),
                'codigo' => 'RA' . trim($rec['id_ra'] ?? ''),
                'descripcion' => $rec['definicion'],
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        // Insertar/actualizar usando upsert para evitar duplicados por 'codigo'
        DB::transaction(function () use ($data) {
            foreach (array_chunk($data, 200) as $chunk) {
                DB::table('resultados_aprendizaje')->upsert(
                    $chunk,
                    ['codigo'], // llave única para evitar duplicados
                    ['modulo_id', 'descripcion', 'updated_at']
                );
            }
        });
    }
}
