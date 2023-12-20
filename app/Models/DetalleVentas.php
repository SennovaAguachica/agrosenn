<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetalleVentas extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        'estado',
        'publicaciones_id',
        'id_venta',
        'cantidad',
        'id_usuario',
        'precio_subtotal',
    ];

    public function usuario()
    {
        return $this->belongsTo(User::class, 'id_usuario', 'id');
    }

    public function publicaciones()
    {
        return $this->belongsTo(Publicaciones::class, 'publicaciones_id', 'id');
    }

    public function ventas()
    {
        return $this->belongsTo(Ventas::class, 'id_venta', 'id');
    }
}
