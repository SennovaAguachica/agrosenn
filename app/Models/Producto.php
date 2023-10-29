<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    use HasFactory;

    protected $guarded = ['id', 'created_at', 'updated_at'];


    // public function subcategory()
    // {
    //     return $this->belongsTo(Subcategoria::class);
    // }


    public function images()
    {
        return $this->morphMany(Image::class, "imageable");
    }
}
