<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class EvidenciaCaseta extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'viaje_id',
        'monto',
        'lugar',
        'tag',
        'observaciones',
        'foto_url',
        'numero_interno',
    ];

    public function viaje(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Viaje::class, 'viaje_id');
    }

}
