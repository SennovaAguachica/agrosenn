<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    use HasFactory;

    protected $guarded = [];
    //URL Amigable
    public function getRouteKeyName()
    {
        return 'slug';
    }
    //Relacion uno a muchos
    public function subcategories()
    {
        return $this->hasMany(Subcategoria::class);
    }

    //Relacion a traves de Categoria->SubCategoria->Producto
    public function products()
    {
        return $this->hasManyThrough(Productos::class, Subcategoria::class);
    }
}
