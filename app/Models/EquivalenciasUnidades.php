<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EquivalenciasUnidades extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        'equivalencia',
        'estado',
        'equivalencias_id',
        'unidades_id',
    ];

    public function equivalencias()
    {
        return $this->belongsTo(Equivalencias::class, 'equivalencias_id', 'id');
    }

    public function unidades()
    {
        return $this->belongsTo(Unidades::class, 'unidades_id', 'id');
    }

    public function inventarios()
    {
        return $this->hasMany(Inventario::class, 'equivalencias_unidades_id', 'id');
    }
}
