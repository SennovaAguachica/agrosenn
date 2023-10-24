<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subcategoria extends Model
{
    use HasFactory;

    protected $guarded = [];

    //Relacion uno a muchos
    public function products()
    {
        return $this->hasMany(Producto::class);
    }
    //Relacion uno a muchos inversa
    public function category()
    {
        return $this->belongsTo(Categorias::class);
    }
}
