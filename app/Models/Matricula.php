<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Matricula extends Model
{
    protected $fillable = [
        'estudiante_id', 'modulo_id',
    ];
    protected $table = 'matriculas';

    public function estudiante(): BelongsTo
    {
        return $this->belongsTo(User::class, 'estudiante_id', 'id');
    }

    public function modulo(): BelongsTo
    {
        return $this->belongsTo(Modulo::class, 'modulo_id', 'id');
    }
}
