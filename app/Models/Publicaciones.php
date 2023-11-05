<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Publicaciones extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        'disponible',
        'estado',
        'producto_id',
        'unidades_id',
        'vendedores_id',
    ];

    //Relacion uno a muchos
    public function productos()
    {
        return $this->belongsTo(Productos::class, 'producto_id', 'id');
    }

    public function unidades()
    {
        return $this->belongsTo(Unidades::class, 'unidades_id', 'id');
    }

    public function vendedores()
    {
        return $this->belongsTo(Vendedores::class, 'vendedores_id', 'id');
    }

    //relacion muchos a muchos
    public function precios()
    {
        return $this->belongsToMany(Precios::class, 'precios_publicacion', 'publicaciones_id', 'precios_id');
    }

    public function imagenes()
    {
        return $this->hasMany(Imagenes::class, 'publicacion_id', 'id');
    }

    public function inventarios()
    {
        return $this->hasMany(Inventario::class, 'publicacion_id', 'id');
    }
}
