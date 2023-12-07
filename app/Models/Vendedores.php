<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vendedores extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        'id_tipodocumento',
        'id_asociacion',
        'id_municipio',
        'n_documento',
        'nombres',
        'apellidos',
        'direccion',
        'n_celular',
        'email',
        'estado',
    ];
    public function usuario()
    {
        return $this->hasOne(User::class, 'idvendedor', 'id');
    }
    public function tipodocumento()
    {
        return $this->belongsTo(Tipodocumentos::class, 'id_tipodocumento', 'id');
    }
    public function municipio()
    {
        return $this->belongsTo(Ciudades::class, 'id_municipio', 'id');
    }
    
    public function asociacion()
    {
        return $this->belongsTo(Asociaciones::class, 'idasociacion', 'id');
    }
}
