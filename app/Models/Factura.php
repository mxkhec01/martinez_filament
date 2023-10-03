<?php

namespace App\Models;

use \DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class
Factura extends Model
{
    use SoftDeletes;
    use HasFactory;

    public $table = 'facturas';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'entrega_id',
        'numero_factura',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function entrega()
    {
        return $this->belongsTo(Entrega::class, 'entrega_id');
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}
