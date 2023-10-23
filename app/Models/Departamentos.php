<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Departamentos extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function municipios()
    {
        return $this->hasMany(Municipios::class);
    }

    public function ordenes()
    {
        return $this->hasMany(Ordenes::class);
    }
}
