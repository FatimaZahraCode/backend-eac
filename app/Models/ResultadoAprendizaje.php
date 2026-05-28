<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ResultadoAprendizaje extends Model
{
    use HasFactory;
     protected $fillable = [
        'modulo_id', 'codigo', 'descripcion','peso_porcentaje'
    ];
    protected $table = 'resultados_aprendizaje';

    public function modulo(): BelongsTo
    {
        return $this->belongsTo(Modulo::class, 'modulo_id');
    }

    public function criteriosEvaluacion(): HasMany
    {
        return $this->hasMany(CriterioEvaluacion::class, 'resultado_aprendizaje_id', 'id');
    }
}
