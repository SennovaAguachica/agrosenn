<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Banners extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        'usuario_id',
        'imagen',
        'estado',
        'enlace',
        'tipobanner'
    ];
    public function asociacion()
    {
        return $this->belongsTo(User::class,'usuario_id','id');
    }
}
