<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PerfilSituacion extends Model
{
    use HasFactory;
    protected $table = 'perfil_situacion';

    protected $fillable = [
        'perfil_habilitacion_id',
        'situacion_competencia_id',
        'gradiente_autonomia',
        'puntuacion_conquista',
        'intentos',
        'fecha_conquista',
    ];

    protected $casts = [
        'gradiente_autonomia' => 'decimal:2',
        'puntuacion_conquista' => 'decimal:2',
        'fecha_conquista' => 'datetime',
    ];

}
