<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Unidades extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        'unidad',
        'abreviatura',
        'descripcion',
        'estado',
    ];

    public function precios()
    {
        return $this->hasMany(Precios::class, 'unidades_id', 'id');
    }

    public function publicaciones()
    {
        return $this->hasMany(Publicaciones::class, 'unidades_id', 'id');
    }

    public function equivalencias_unidades()
    {
        return $this->hasMany(EquivalenciasUnidades::class, 'unidades_id', 'id');
    }
}
