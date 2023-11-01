<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tipodocumentos extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        'tipo_documento',
    ];
    public function vendedores()
    {
      return $this->hasMany(Vendedores::class,'id_tipodocumento','id');
    }
}
