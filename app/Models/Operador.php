<?php

namespace App\Models;

use \DateTimeInterface;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Operador extends Authenticatable
{
    use SoftDeletes;
    use HasFactory;
    use HasApiTokens;

    public $table = 'operadors';

    protected $dates = [
        'fecha_nacimiento',
        'fecha_ingreso',
        'vence',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'nombre',
        'fecha_nacimiento',
        'fecha_ingreso',
        'licencia',
        'vence',
        'tipo_licencia',
        'imss',
        'rfc',
        'curp',
        'tarjeta_bancaria',
        'banco',
        'usuario',
        'password',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

//    public function getFechaNacimientoAttribute($value)
//    {
//        return $value ? Carbon::parse($value)->format(config('panel.date_format')) : null;
//    }
//
//    public function setFechaNacimientoAttribute($value)
//    {
//        $this->attributes['fecha_nacimiento'] = $value ? Carbon::createFromFormat(config('panel.date_format'), $value)->format('Y-m-d') : null;
//    }
//
//    public function getFechaIngresoAttribute($value)
//    {
//        return $value ? Carbon::parse($value)->format(config('panel.date_format')) : null;
//    }
//
//    public function setFechaIngresoAttribute($value)
//    {
//        $this->attributes['fecha_ingreso'] = $value ? Carbon::createFromFormat(config('panel.date_format'), $value)->format('Y-m-d') : null;
//    }
//
//    public function getVenceAttribute($value)
//    {
//        return $value ? Carbon::parse($value)->format(config('panel.date_format')) : null;
//    }
//
//    public function setVenceAttribute($value)
//    {
//        $this->attributes['vence'] = $value ? Carbon::createFromFormat(config('panel.date_format'), $value)->format('Y-m-d') : null;
//    }
//
//    protected function serializeDate(DateTimeInterface $date)
//    {
//        return $date->format('Y-m-d H:i:s');
//    }

    public function viajes()
    {
        return $this->hasMany(Viaje::class);
    }

//    public function setPasswordAttribute($input)
//    {
//        if ($input) {
////            $this->attributes['password'] = app('hash')->needsRehash($input) ? Hash::make($input) : $input;
//
//            $this->attributes['password'] = md5($input);
//        }
//    }
}
