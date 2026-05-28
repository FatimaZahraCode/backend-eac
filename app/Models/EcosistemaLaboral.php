<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Testing\Fluent\Concerns\Has;

class EcosistemaLaboral extends Model
{
    use HasFactory;
    protected $fillable = [
        'modulo_id', 'nombre', 'codigo', 'descripcion', 'activo',
    ];

    protected $table = 'ecosistemas_laborales';

    protected $casts = ['activo' => 'boolean'];

    public function modulo(): BelongsTo
    {
        return $this->belongsTo(Modulo::class, 'modulo_id', 'id');
    }

    public function situacionesCompetencia(): HasMany
    {
        return $this->hasMany(SituacionCompetencia::class, 'ecosistema_laboral_id', 'id');
    }

    public function matriculas(): HasMany
    {
        return $this->hasMany(Matricula::class, 'ecosistema_laboral_id', 'id');
    }

    public function perfilesHabilitacion(): HasMany
    {
        return $this->hasMany(PerfilHabilitacion::class, 'ecosistema_laboral_id', 'id');
    }
}
