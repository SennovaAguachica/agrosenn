<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Asociaciones extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        'asociacion',
        'codigo_asociacion',
        'n_celular',
        'direccion',
        'email',
        'id_municipio',
        'descripcion',
        'estado',
    ];
    public function municipio()
    {
        return $this->belongsTo(Ciudades::class,'id_municipio','id');
    }
    public function usuario()
    {
      return $this->hasOne(User::class,'idasociacion','id');
    }
    public function vendedores()
    {
        return $this->hasMany(Vendedores::class, 'id_asociacion', 'id');
    }
}
