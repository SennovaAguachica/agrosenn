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
  ];
  public function productos()
  {
    return $this->hasMany(Productos::class);
  }
}
