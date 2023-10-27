<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Productos extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        'categoria_id',
        'producto',
        'precio',
        'descripcion',
        'imagen',
        'estado',
    ];
    // public function categoria()
    // {
    //     return $this->belongsTo(Categoria::class, 'categoria_id', 'id');
    // }
}
