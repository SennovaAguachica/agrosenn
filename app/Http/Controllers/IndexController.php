<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Categorias;
use App\Models\Subcategorias;
use App\Models\Asociaciones;
use App\Models\Vendedores;
use App\Models\Publicaciones;

class IndexController extends Controller
{
    public function index()
    {
        $categorias  = Categorias::with('subcategorias')->get();
        $subcategorias = Subcategorias::whereHas('productos.publicaciones', function ($query) {
            $query->where('estado', 1);
        })->get();
        $subcategoriasAleatorias = $subcategorias->count() > 5
        ? $subcategorias->random(5)
        : $subcategorias;
        $perfil = auth()->user();
        $asociaciones = Asociaciones::all();
        $publicaciones = Publicaciones::with('productos.subcategoria.categorias','imagenes','usuario.vendedor','precios','unidades')->where('estado',1)->whereHas('productos', function ($query) use ($subcategoriasAleatorias) {
            $query->whereIn('subcategoria_id', $subcategoriasAleatorias->pluck('id'));
        })
        ->get();
        // dd($publicaciones);
        return view('vistas.frontend.index.index', compact('categorias', 'subcategorias','perfil','asociaciones','subcategoriasAleatorias','publicaciones'));
    }
    public function verAsociaciones()
    {
        $categorias = Categorias::with('subcategorias')->get();
        $subcategorias = Subcategorias::all();
        $perfil = auth()->user();
        $asociaciones = Asociaciones::with('usuario','vendedores')->get();
        //dd($categorias);
        return view('vistas.frontend.paginas.verasociaciones', compact('categorias', 'subcategorias','perfil','asociaciones'));
    }
    public function verVendedores($idasociacion)
    {
        $vendedores = Vendedores::with('usuario.publicaciones')->where('id_asociacion',$idasociacion)->get();
        $categorias = Categorias::with('subcategorias')->get();
        $subcategorias = Subcategorias::all();
        $perfil = auth()->user();
        $asociacion = Asociaciones::with('usuario')->findOrFail($idasociacion);
        $asociaciones = Asociaciones::with('usuario')->get();
        return view('vistas.frontend.paginas.vervendedores', compact('categorias', 'subcategorias','perfil','asociacion','vendedores','asociaciones'));
    }
    public function verProductos($idvendedor)
    {
        $vendedor = Vendedores::with('usuario.publicaciones.productos','usuario.publicaciones.precios','usuario.publicaciones.unidades', 'usuario.publicaciones.imagenes')->findOrFail($idvendedor);
        $categorias = Categorias::with('subcategorias')->get();
        $subcategorias = Subcategorias::all();
        $perfil = auth()->user();
        $asociaciones = Asociaciones::with('usuario')->get();
        return view('vistas.frontend.paginas.verproductos', compact('categorias', 'subcategorias','perfil','vendedor','asociaciones'));
    }
    public function verCategoria($idcategoria)
    {
        $categoria = Categorias::with('subcategorias')->findOrFail($idcategoria);
        $categorias = Categorias::with('subcategorias')->get();
        $perfil = auth()->user();
        $asociaciones = Asociaciones::with('usuario')->get();
        $publicaciones = Publicaciones::with('productos.subcategoria.categorias','imagenes','usuario.vendedor','precios','unidades')->where('estado',1)->whereHas('productos.subcategoria', function ($query) use ($idcategoria) {
            $query->where('categoria_id', $idcategoria);
        })
        ->get();
        $subcategoriasConPublicaciones = Subcategorias::where('categoria_id', $idcategoria)
        ->select('subcategorias.*')
        ->selectSub(function ($query) {
            $query->selectRaw('COUNT(publicaciones.id)')
                ->from('productos')
                ->join('publicaciones', 'productos.id', '=', 'publicaciones.producto_id')
                ->whereColumn('productos.subcategoria_id', 'subcategorias.id')
                ->where('publicaciones.estado', 1);
        }, 'npublicaciones')
        ->having('npublicaciones', '>', 0)
        ->get();
        // dd($subcategoriasConPublicaciones);
        return view('vistas.frontend.paginas.vercategoria', compact('categorias', 'categoria','perfil','asociaciones','publicaciones','subcategoriasConPublicaciones'));
    }
    public function verSubcategoria($idsubcategoria)
    {
        $subcategoria = Subcategorias::findOrFail($idsubcategoria);
        $categorias = Categorias::with('subcategorias')->get();
        $perfil = auth()->user();
        $asociaciones = Asociaciones::with('usuario')->get();
        $publicaciones = Publicaciones::with('productos.subcategoria.categorias','imagenes','usuario.vendedor','precios','unidades')->where('estado',1)->whereHas('productos', function ($query) use ($idsubcategoria) {
            $query->where('subcategoria_id', $idsubcategoria);
        })
        ->get();
        $subcategoriasConPublicaciones = Subcategorias::where('categoria_id', $subcategoria->categoria_id)
        ->select('subcategorias.*')
        ->selectSub(function ($query) {
            $query->selectRaw('COUNT(publicaciones.id)')
                ->from('productos')
                ->join('publicaciones', 'productos.id', '=', 'publicaciones.producto_id')
                ->whereColumn('productos.subcategoria_id', 'subcategorias.id')
                ->where('publicaciones.estado', 1);
        }, 'npublicaciones')
        ->having('npublicaciones', '>', 0)
        ->get();
        return view('vistas.frontend.paginas.versubcategoria', compact('categorias', 'subcategoria','perfil','asociaciones','publicaciones','subcategoriasConPublicaciones'));

    }
    public function verPublicacion($idpublicacion)
    {
        $categorias = Categorias::with('subcategorias')->get();
        $perfil = auth()->user();
        $asociaciones = Asociaciones::with('usuario')->get();
        $publicacion = Publicaciones::with('productos.subcategoria.categorias','imagenes','usuario.vendedor','precios','unidades')->findOrFail($idpublicacion);
        return view('vistas.frontend.paginas.verpublicacion', compact('categorias', 'perfil','asociaciones','publicacion'));

    }
}
