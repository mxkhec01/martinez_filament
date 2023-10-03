<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class EvidenciaCombustible extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'viaje_id',
        'monto',
        'litros',
        'km',
        'convenio',
        'foto1_url',
        'foto2_url',
        'foto3_url',
        'foto4_url',
        'foto5_url',
        'numero_interno',
    ];

    public function viaje(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Viaje::class, 'viaje_id');
    }

}
