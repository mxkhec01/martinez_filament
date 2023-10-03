<?php

namespace App\Models;

use \DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Cliente extends Model
{
    use SoftDeletes;
    use HasFactory;

    public $table = 'clientes';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    /**
     * @param string[] $fillable
     */

    protected $fillable = [
        'razon_social',
        'calle',
        'numero_exterior',
        'colonia',
        'codigo_postal',
        'estado',
        'ciudad',
        'created_at',
        'updated_at',
        'deleted_at',
        'latitud',
        'longitud',
    ];


    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}
