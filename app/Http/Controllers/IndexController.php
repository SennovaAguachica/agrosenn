<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Categorias;
use App\Models\Subcategorias;

class IndexController extends Controller
{
    public function index()
    {
        $categorias = Categorias::all();
        $subcategorias = Subcategorias::all();
        //dd($categorias);
        return view('vistas.frontend.index.index', compact('categorias', 'subcategorias'));
    }
}
