<?php

namespace App\Models;

use \DateTimeInterface;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Entrega extends Model
{
    use SoftDeletes;
    use HasFactory;

    public $table = 'entregas';

    protected $dates = [
        'fecha_llegada',
        'fecha_entrega',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'viaje_id',
        'cliente_id',
        'fecha_llegada',
        'fecha_entrega',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function viaje()
    {
        return $this->belongsTo(Viaje::class, 'viaje_id');
    }

    public function cliente()
    {
        return $this->belongsTo(Cliente::class, 'cliente_id');
    }

    public function facturas()
    {
        return $this->hasMany(Factura::class);
    }

    public function getFechaLlegadaAttribute($value)
    {
        return $value ? Carbon::parse($value)->format('Y-m-d H:i:s') : null;
    }

    // public function setFechaLlegadaAttribute($value)
    // {
    //     $this->attributes['fecha_llegada'] = $value ? Carbon::createFromFormat(config('panel.date_format'), $value)->format('Y-m-d') : null;
    // }

     public function getFechaEntregaAttribute($value)
     {
         return $value ? Carbon::parse($value)->format('Y-m-d H:i:s') : null;
     }

    // public function setFechaEntregaAttribute($value)
    // {
    //     $this->attributes['fecha_entrega'] = $value ? Carbon::createFromFormat(config('panel.date_format'), $value)->format('Y-m-d') : null;
    // }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}
