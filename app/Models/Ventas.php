<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ventas extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        'fecha_venta',
        'estado',
        'iva',
        'idcliente',
    ];

    public function cliente()
    {
        return $this->belongsTo(Clientes::class, 'idcliente', 'id');
    }
}
