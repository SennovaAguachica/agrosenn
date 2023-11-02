<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categorias extends Model
{
  use HasFactory;
  protected $fillable = [
    'id',
    'categoria',
    'descripcion',
    'imagen',
    'icono',
    'estado',
  ];
  // public function productos()
  // {
  //   return $this->hasMany(Productos::class);
  // }
  // public function products()
  //   {
  //       // return $this->hasManyThrough(Producto::class, Subcategoria::class);

  //   }
  public function subcategorias()
  {
    //return $this->hasMany(Subcategorias::class, 'id_categoria', 'id');
    return $this->hasMany(Subcategorias::class, 'categoria_id', 'id');
  }
}
