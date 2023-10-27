<?php



namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subcategorias extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'subcategoria',
        'descripcion',
        'imagen',
        'categoria_id',
        'estado',
    ];

    //Relacion uno a muchos
    // public function products()
    // {
    //     return $this->hasMany(Producto::class);
    // }
    //Relacion uno a muchos inversa
    public function categorias()
    {
        return $this->belongsTo(Categorias::class, 'categoria_id', 'id');
    }
}
