<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Imagenes extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'ruta',
        'nombre',
        //'id_producto',
        'estado',
    ];
    // public function producto()
    // {
    //     return $this->belongsTo(Productos::class, 'producto_id', 'id');
    // }
}
