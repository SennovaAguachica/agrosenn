<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Categorias;

class IndexController extends Controller
{
    public function index()
    {
        $categorias = Categorias::all();
        //dd($categorias);
        return view('vistas.frontend.index.index', compact('categorias'));
    }
}
