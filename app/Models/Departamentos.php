<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Departamentos extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        'departamento'
    ];
    public function ciudades()
    {
      return $this->hasMany(Ciudades::class,'id','id');
    }
}
