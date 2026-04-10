<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ModulosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $path = database_path('seeders/csv/modulos.csv');
        $path2 = database_path('seeders/csv/ciclo_modulo_relaciones.csv');

        if (!file_exists($path)) {
            $this->command->error("CSV no encontrado: $path");
            return;
        }
        if (!file_exists($path2)) {
            $this->command->error("CSV no encontrado: $path2");
            return;
        }

        // Leer todas las líneas y parsear con str_getcsv
        $rows = array_map('str_getcsv', file($path));
        $rows2 = array_map('str_getcsv', file($path2));

        // El primer registro es la cabecera
        $header = array_map('trim', array_shift($rows));
        $header2 = array_map('trim', array_shift($rows2));

        $data = [];
        $relaciones = [];
        $ciclo_formativo_id = DB::table('ciclos_formativos')->pluck('id', 'codigo');

        foreach ($rows2 as $row2) {
            // Ignorar filas vacías o mal formadas
            if (count($row2) < count($header2)) {
                continue;
            }

            $rec2 = array_combine($header2, $row2);
            $cod_modulo_id = trim($rec2['cod_modulo'] ?? '');
            $relaciones[$cod_modulo_id][] = trim($rec2['cod_ciclo'] ?? '');
        }
        foreach ($rows as $row) {
            // Ignorar filas vacías o mal formadas
            if (count($row) < count($header)) {
                continue;
            }


            $rec = array_combine($header, $row);
            foreach ($relaciones[trim($rec['cod_modulo'] ?? '')] ?? [] as $cod_ciclo) {
                $data[] = [
                    'ciclo_formativo_id' => $ciclo_formativo_id[$cod_ciclo] ?? null,
                    'nombre' => trim($rec['nombre_modulo'] ?? ''),
                    'codigo' => trim($rec['cod_modulo'] ?? ''),
                    'horas_totales' => (int) ($rec['horas_totales'] ?? 0),
                    'descripcion' => $rec['descripcion'] ?? null,
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
            }
        }


        // Insertar/actualizar usando upsert para evitar duplicados por 'codigo'
        DB::transaction(function () use ($data, $relaciones) {
            foreach (array_chunk($data, 200) as $chunk) {
                DB::table('modulos')->upsert(
                    $chunk,
                    ['codigo'], // llave única para evitar duplicados
                    ['ciclo_formativo_id', 'nombre', 'codigo', 'horas_totales', 'descripcion', 'updated_at']
                );
            }
        });
    }
}
