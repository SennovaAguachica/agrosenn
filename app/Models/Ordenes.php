<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ordenes extends Model
{
    use HasFactory;

    protected $guarded = [];
    const PENDIENTE = 1;
    const RECIBIDO = 2;
    const ENVIADO = 3;
    const ENTREGADO = 4;
    const ANULADO = 5;

    public function departmento()
    {
        return $this->belongsTo(Departamentos::class);
    }

    public function municipio()
    {
        return $this->belongsTo(Municipios::class);
    }

    public function direccion()
    {
        return $this->belongsTo(Direcciones::class);
    }
}
