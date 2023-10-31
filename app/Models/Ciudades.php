<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ciudades extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        'iddepartamentos',
        'ciudad'
    ];
    public function departamento()
    {
        return $this->belongsTo(Departamentos::class,'iddepartamentos','id');
    }
    public function vendedores()
    {
      return $this->hasMany(Vendedores::class,'id_municipio','id');
    }
}
