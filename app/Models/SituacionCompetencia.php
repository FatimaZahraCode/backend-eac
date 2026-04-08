<?php

namespace App\Models;

use App\Models\EcosistemaLaboral;
use App\Models\NodoRequisito;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;


class SituacionCompetencia extends Model
{

    protected $table = 'situaciones_competencia';
    protected $fillable = ['ecosistema_laboral_id', 'codigo', 'titulo', 'descripcion', 'umbral_maestria', 'nivel_complejidad', 'activa'];
    protected $casts = [
        'activa' => 'boolean',
        'umbral_maestria' => 'decimal:2',
    ];
    // Relación con EcosistemaLaboral
    public function ecosistemaLaboral():BelongsTo
    {
        return $this->belongsTo(EcosistemaLaboral::class);
    }
    //Relacion con nodoRequisito
    public function nodoRequisito():HasMany
    {
        return $this->hasMany(NodoRequisito::class);
    }
    //Relación de prerequisitos (belongsToMany a sí mismo)
    public function prerequisitos()
    {
        return $this->belongsToMany(SituacionCompetencia::class, 'sc_precedencia','sc_id', 'sc_requisito_id');
    }
    //Relación de dependientes (belongsToMany a sí mismo)
    public function dependientes()
    {
        return $this->belongsToMany(SituacionCompetencia::class, 'sc_precedencia','sc_requisito_id', 'sc_id');
    }
    //Relación con CriterioEvaluacion (belongsToMany)
    public function criteriosEvaluacion()
    {
        return $this->belongsToMany(CriterioEvaluacion::class, 'sc_criterios_evaluacion','situacion_competencia_id', 'criterio_evaluacion_id');
    }
    //Relación con PerfilesHabilitacion a través de PerfilSituacion (belongsToMany)
    public function perfilesHabilitacion()
    {
        return $this->belongsToMany(PerfilHabilitacion::class, 'perfil_situacion', 'situacion_competencia_id', 'perfil_habilitacion_id');
    }


}
