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
        'iva',
        'idcliente',
        'estado',
        'publicaciones_id',
        'cantidad',
        'id_usuario',
        'precio_subtotal',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->iva = $model->iva ?? 0;
        });
    }

    public function cliente()
    {
        return $this->belongsTo(Clientes::class, 'idcliente', 'id');
    }

    public function usuario()
    {
        return $this->belongsTo(User::class, 'id_usuario', 'id');
    }

    public function publicaciones()
    {
        return $this->belongsTo(Publicaciones::class, 'publicaciones_id', 'id');
    }

    public function detalleVentas()
    {
        return $this->hasMany(DetalleVentas::class, 'id_venta', 'id');
    }
}
