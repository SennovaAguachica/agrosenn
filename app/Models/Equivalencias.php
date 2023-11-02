<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Equivalencias extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'unidad',
        'estado',
    ];
    public function equivalencias_unidades()
    {
        return $this->hasMany(EquivalenciasUnidades::class, 'equivalencias_id', 'id');
    }
}
