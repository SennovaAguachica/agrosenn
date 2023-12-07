<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Publicaciones extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        // 'ofertado',
        'estado',
        'producto_id',
        'unidades_id',
        'id_usuario',
        'precios_id',
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

    public function usuario()
    {
        return $this->belongsTo(User::class, 'id_usuario', 'id');
    }

    public function precios()
    {
        return $this->belongsTo(Precios::class, 'precios_id', 'id');
    }
    public function equivalencias_unidades()
    {
        return $this->belongsTo(EquivalenciasUnidades::class, 'equivalencias_unidades_id', 'id');
    }
    public function imagenes()
    {
        return $this->hasMany(Imagenes::class, 'publicaciones_id', 'id');
    }

    public function inventarios()
    {
        return $this->hasMany(Inventario::class, 'publicacion_id', 'id');
    }
}
