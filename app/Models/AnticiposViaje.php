<?php

namespace App\Models;

use \DateTimeInterface;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AnticiposViaje extends Model
{
    use SoftDeletes;
    use HasFactory;

    public $table = 'anticipos_viajes';

    protected $dates = [
        'fecha',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'viaje_id',
        'monto',
        'descripcion',
        'fecha',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function viaje()
    {
        return $this->belongsTo(Viaje::class, 'viaje_id');
    }

    public function getFechaAttribute($value)
    {
        return $value ? Carbon::parse($value)->format(config('panel.date_format')) : null;
    }

    public function setFechaAttribute($value)
     {
         $this->attributes['fecha'] = $value ? Carbon::createFromFormat(config('panel.date_format'), $value)->format('Y-m-d') : null;
     }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}
