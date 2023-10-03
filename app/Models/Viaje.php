<?php

namespace App\Models;

use Carbon\Carbon;
use \DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use App\Support\HasAdvancedFilter;


class Viaje extends Model
{
    use SoftDeletes;
    use HasFactory;
//    use HasAdvancedFilter;

    public const ESTADO_SELECT = [
        'activo'     => 'Activo',
        'revision'   => 'En Revisión',
        'asignar'    => 'Por Asignar',
        'finalizado' => 'Finalizado',
    ];

    public const CARGA_SELECT = [
        'ligera'     => 'Carga Ligera',
        'promedio'   => 'Carga Promedio',
        'pesada'     => 'Carga Pesada',
    ];

    public const ESTADO_BACKGROUND = [
        'activo'     => 'activo',
        'revision'   => 'bg-danger',
        'asignar'    => 'bg-warning',
        'finalizado' => 'bg-info',
    ];

    public const GASTOS_OTROS = [
        'HOTELES'     => 'Hoteles',
        'MISC'        => 'Misceláneos',
        'COMIDAS'    => 'Comidas',
        'MANIOBRAS' => 'Maniobras',
        'OTROS' => 'Otros',
    ];

    public $table = 'viajes';

    public $orderable = [
        'id',
        'viaje',
        'otro',
    ];

    public $filterable = [
        'id',
        'viaje',
        'otro',
    ];

    protected $dates = [
        'fecha_pago',
        'fecha_inicio',
        'fecha_fin',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'nombre_viaje',
        'destino',
        'unidad_id',
        'operador_id',
        'estado',
        'monto_pagado',
        'fecha_pago',
        'fecha_inicio',
        'fecha_fin',
        'created_at',
        'updated_at',
        'deleted_at',
        'carga',
        'comentarios',
        'esconder',
    ];

    public function unidad()
    {
        return $this->belongsTo(Unidad::class, 'unidad_id');
    }

    public function operador()
    {
        return $this->belongsTo(Operador::class, 'operador_id');
    }

    public function entregas(){
        return $this->hasMany(Entrega::class);
    }

    public function anticipos(){
        return $this->hasMany(AnticiposViaje::class);
    }

//    protected function serializeDate(DateTimeInterface $date)
//    {
//        return $date->format('Y-m-d H:i:s');
//    }

    public function casetas(){
        return $this->hasMany(EvidenciaCaseta::class)->orderBy('numero_interno');
    }

    public function combustibles(){
        return $this->hasMany(EvidenciaCombustible::class)->orderBy('numero_interno');
    }

    public function facturas()
    {
        return $this->hasManyThrough(Factura::class, Entrega::class);
    }

    public function gastos()
    {
        return $this->hasMany(EvidenciaOtro::class)->orderBy('numero_interno');
    }

//    public function getFechaInicioAttribute($value)
//    {
//        return $value ? Carbon::parse($value)->format(config('panel.date_format')) : null;
//    }

//    public function setFechaInicioAttribute($value)
//    {
//        $this->attributes['fecha_inicio'] = $value ? Carbon::createFromFormat(config('panel.date_format'), $value)->format('Y-m-d') : null;
//    }
//
//    public function getFechaFinAttribute($value)
//    {
//        return $value ? Carbon::parse($value)->format(config('panel.date_format')) : null;
//    }
//
//    public function setFechaFinAttribute($value)
//    {
//        $this->attributes['fecha_fin'] = $value ? Carbon::createFromFormat(config('panel.date_format'), $value)->format('Y-m-d') : null;
//    }
}
