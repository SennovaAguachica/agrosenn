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
        'publicaciones_id',
    ];
    public function publicaciones()
    {
        return $this->belongsTo(Publicaciones::class, 'publicaciones_id', 'id');
    }
}
