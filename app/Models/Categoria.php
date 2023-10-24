<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    use HasFactory;

    protected $guarded = [];

    //Relacion uno a muchos
    public function subcategories()
    {
        return $this->hasMany(Subcategoria::class);
    }

    //Relacion a traves de Categoria->SubCategoria->Producto
    public function products()
    {
        return $this->hasManyThrough(Producto::class, Subcategoria::class);
    }
}
