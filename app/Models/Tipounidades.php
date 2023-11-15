<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tipounidades extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        'tipo_unidad',
        'estado',
    ];

    public function unidades()
    {
        return $this->hasMany(Unidades::class, 'tipounidades_id', 'id');
    }
}
