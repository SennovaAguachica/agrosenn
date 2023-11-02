<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inventario extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        'stock',
        'estado',
        'publicaciones_id',
        'equivalencias_unidades_id',
    ];

    public function publicaciones()
    {
        return $this->belongsTo(Publicaciones::class, 'publicaciones_id', 'id');
    }

    public function equivalencias_unidades()
    {
        return $this->belongsTo(EquivalenciasUnidades::class, 'equivalencias_unidades_id', 'id');
    }
}
