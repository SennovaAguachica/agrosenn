<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Precios extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        'precio',
        'estado',
        'producto_id',
        'unidades_id',
        'id_asociacion',
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

    public function asociacion()
    {
        return $this->belongsTo(Asociaciones::class, 'id_asociacion', 'id');
    }

    //relacion muchos a muchos
    public function publicaciones()
    {
        return $this->belongsToMany(Publicaciones::class, 'precios_publicacion', 'precios_id', 'publicaciones_id');
    }
}
