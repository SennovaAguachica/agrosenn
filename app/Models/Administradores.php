<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Administradores extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        'administrador',
    ];
    public function usuarios()
    {
      return $this->hasMany(User::class,'idadministrador','id');
    }
}
