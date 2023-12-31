<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Productos extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        'producto',
        'descripcion',
        'imagen',
        'subcategoria_id',
        'estado',
    ];
    public function subcategoria()
    {
        return $this->belongsTo(Subcategorias::class, 'subcategoria_id', 'id');
    }

    public function precios()
    {
        return $this->hasMany(Precios::class, 'producto_id', 'id');
    }

    public function publicaciones()
    {
        return $this->hasMany(Publicaciones::class, 'producto_id', 'id');
    }
}
