<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Categorias;
use App\Models\Subcategorias;
use App\Models\Asociaciones;
use App\Models\Vendedores;

class IndexController extends Controller
{
    public function index()
    {
        $categorias = Categorias::all();
        $subcategorias = Subcategorias::all();
        $perfil = auth()->user();
        $asociaciones = Asociaciones::all();
        //dd($categorias);
        return view('vistas.frontend.index.index', compact('categorias', 'subcategorias','perfil','asociaciones'));
    }
    public function verAsociaciones()
    {
        $vendedor = [];
        $categorias = Categorias::all();
        $subcategorias = Subcategorias::all();
        $perfil = auth()->user();
        $asociaciones = Asociaciones::with('usuario','vendedores')->get();
        //dd($categorias);
        return view('vistas.frontend.paginas.verasociaciones', compact('categorias', 'subcategorias','perfil','asociaciones','vendedor'));
    }
    public function verVendedores($idasociacion)
    {
        $vendedores = Vendedores::with('usuario')->where('id_asociacion',$idasociacion)->get();
        $categorias = Categorias::all();
        $subcategorias = Subcategorias::all();
        $perfil = auth()->user();
        $asociacion = Asociaciones::with('usuario')->findOrFail($idasociacion);
        $asociaciones = Asociaciones::with('usuario')->get();
        return view('vistas.frontend.paginas.vervendedores', compact('categorias', 'subcategorias','perfil','asociacion','vendedores','asociaciones'));
    }
    public function verProductos($idvendedor)
    {
        $vendedor = Vendedores::with('usuario.publicaciones.productos','usuario.publicaciones.precios','usuario.publicaciones.unidades', 'usuario.publicaciones.imagenes')->findOrFail($idvendedor);
        $categorias = Categorias::all();
        $subcategorias = Subcategorias::all();
        $perfil = auth()->user();
        $asociaciones = Asociaciones::with('usuario')->get();
        return view('vistas.frontend.paginas.verproductos', compact('categorias', 'subcategorias','perfil','vendedor','asociaciones'));
    }
}
