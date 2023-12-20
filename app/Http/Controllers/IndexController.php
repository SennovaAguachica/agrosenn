<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Categorias;
use App\Models\Subcategorias;
use App\Models\Asociaciones;
use App\Models\Vendedores;
use App\Models\Publicaciones;
use App\Models\Banners;
use Illuminate\Support\Facades\DB;
use Illuminate\Pagination\Paginator;
use App\Models\Tipodocumentos;
use App\Models\Departamentos;

class IndexController extends Controller
{
    public function index()
    {
        $categorias  = Categorias::with('subcategorias')->get();
        $tiposDocumentos = Tipodocumentos::all();
        $departamentos = Departamentos::all();
        $subcategorias = Subcategorias::whereHas('productos.publicaciones', function ($query) {
            $query->where('estado', 1);
        })->get();
        $subcategoriasAleatorias = $subcategorias->count() > 5
        ? $subcategorias->random(5)
        : $subcategorias;
        $perfil = auth()->user();
        switch (isset($perfil->idrol)) {
            case 1:
                $perfil->load('administrador');
                break;
            case 2:
                $perfil->load('asociacion.municipio.departamento.ciudades','imagenesperfil');
                break;
            case 3:
                $perfil->load('vendedor.municipio.departamento.ciudades','imagenesperfil');
                break;
            case 4:
                $perfil->load('cliente.municipio.departamento.ciudades');
                break;
        }
        $asociaciones = Asociaciones::all();
        $publicaciones = Publicaciones::with('productos.subcategoria.categorias','imagenes','usuario.vendedor','usuario.asociacion','precios','unidades')->where('estado',1)->whereHas('productos', function ($query) use ($subcategoriasAleatorias) {
            $query->whereIn('subcategoria_id', $subcategoriasAleatorias->pluck('id'));
        })
        ->get();
        $bannersprincipales = Banners::where('tipobanner',1)->get();
        $bannerssecundarios = Banners::where('tipobanner',2)->get();
        $bannerssecundariosAleatorias = $bannerssecundarios->count() > 3
        ? $bannerssecundarios->random(3)
        : $bannerssecundarios;
        // dd($publicaciones);
        return view('vistas.frontend.index.index', compact('categorias', 'subcategorias','perfil','asociaciones','subcategoriasAleatorias','publicaciones','bannersprincipales','bannerssecundariosAleatorias','tiposDocumentos','departamentos'));
    }
    public function verAsociaciones()
    {
        $categorias = Categorias::with('subcategorias')->get();
        $subcategorias = Subcategorias::all();
        $perfil = auth()->user();
        $asociaciones = Asociaciones::with('usuario','vendedores')->get();
        $tiposDocumentos = Tipodocumentos::all();
        $departamentos = Departamentos::all();
        return view('vistas.frontend.paginas.verasociaciones', compact('categorias', 'subcategorias','perfil','asociaciones','tiposDocumentos','departamentos'));
    }
    public function verVendedores($idasociacion)
    {
        $vendedores = Vendedores::with('usuario.publicaciones')->where('id_asociacion',$idasociacion)->get();
        $categorias = Categorias::with('subcategorias')->get();
        $subcategorias = Subcategorias::all();
        $perfil = auth()->user();
        $asociacion = Asociaciones::with('usuario')->findOrFail($idasociacion);
        $asociaciones = Asociaciones::with('usuario')->get();
        $tiposDocumentos = Tipodocumentos::all();
        $departamentos = Departamentos::all();
        return view('vistas.frontend.paginas.vervendedores', compact('categorias', 'subcategorias','perfil','asociacion','vendedores','asociaciones','tiposDocumentos','departamentos'));
    }
    public function verProductos($idvendedor)
    {
        $vendedor = Vendedores::with('usuario.publicaciones.productos','usuario.publicaciones.precios','usuario.publicaciones.unidades', 'usuario.publicaciones.imagenes','usuario.imagenesperfil')->findOrFail($idvendedor);
        $categorias = Categorias::with('subcategorias')->get();
        $subcategorias = Subcategorias::all();
        $perfil = auth()->user();
        $asociaciones = Asociaciones::with('usuario')->get();
        $tiposDocumentos = Tipodocumentos::all();
        $departamentos = Departamentos::all();
        return view('vistas.frontend.paginas.verproductos', compact('categorias', 'subcategorias','perfil','vendedor','asociaciones','tiposDocumentos','departamentos'));
    }
    public function verCategoria($idcategoria)
    {
        $categoria = Categorias::with('subcategorias')->findOrFail($idcategoria);
        $categorias = Categorias::with('subcategorias')->get();
        $perfil = auth()->user();
        $asociaciones = Asociaciones::with('usuario')->get();
        $tiposDocumentos = Tipodocumentos::all();
        $departamentos = Departamentos::all();
        $publicaciones = Publicaciones::with('productos.subcategoria.categorias','imagenes','usuario.vendedor','precios','unidades')->where('estado',1)->whereHas('productos.subcategoria', function ($query) use ($idcategoria) {
            $query->where('categoria_id', $idcategoria);
        })
        ->paginate(10);
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
        return view('vistas.frontend.paginas.vercategoria', compact('categorias', 'categoria','perfil','asociaciones','publicaciones','subcategoriasConPublicaciones','tiposDocumentos','departamentos'));
    }
    public function verSubcategoria($idsubcategoria)
    {
        $subcategoria = Subcategorias::findOrFail($idsubcategoria);
        $categorias = Categorias::with('subcategorias')->get();
        $perfil = auth()->user();
        $asociaciones = Asociaciones::with('usuario')->get();
        $tiposDocumentos = Tipodocumentos::all();
        $departamentos = Departamentos::all();
        $publicaciones = Publicaciones::with('productos.subcategoria.categorias','imagenes','usuario.vendedor','precios','unidades')->where('estado',1)->whereHas('productos', function ($query) use ($idsubcategoria) {
            $query->where('subcategoria_id', $idsubcategoria);
        })
        ->paginate(10);
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
        return view('vistas.frontend.paginas.versubcategoria', compact('categorias', 'subcategoria','perfil','asociaciones','publicaciones','subcategoriasConPublicaciones','tiposDocumentos','departamentos'));

    }
    public function verPublicacion($idpublicacion)
    {
        $categorias = Categorias::with('subcategorias')->get();
        $tiposDocumentos = Tipodocumentos::all();
        $departamentos = Departamentos::all();
        $perfil = auth()->user();
        $asociaciones = Asociaciones::with('usuario')->get();
        $publicacion = Publicaciones::with('productos.subcategoria.categorias','imagenes','usuario.vendedor.municipio.departamento','usuario.asociacion.municipio.departamento','precios','unidades')->findOrFail($idpublicacion);
        $relacionados = Publicaciones::with('productos.subcategoria.categorias','imagenes','usuario.vendedor','precios','unidades')->where('estado',1)->whereHas('productos', function ($query) use ($publicacion) {
            $query->where('subcategoria_id', $publicacion->productos->subcategoria_id);
        })->where('id', '!=', $idpublicacion)->get();
        return view('vistas.frontend.paginas.verpublicacion', compact('categorias', 'perfil','asociaciones','publicacion','relacionados','tiposDocumentos','departamentos'));

    }
    public function buscarProductos(Request $request)
    {
        $categorias = Categorias::with('subcategorias')->get();
        $tiposDocumentos = Tipodocumentos::all();
        $departamentos = Departamentos::all();
        $perfil = auth()->user();
        $asociaciones = Asociaciones::with('usuario')->get();
        $resultados = Publicaciones::with('productos.subcategoria.categorias','imagenes','usuario.vendedor.municipio.departamento','usuario.asociacion.municipio.departamento','precios','unidades')->
        join('productos as pro', 'pro.id', '=', 'publicaciones.producto_id')
        ->where('publicaciones.estado',1)
        ->where(function ($query) use ($request) {
            $query->where('publicaciones.descripcion', 'LIKE', '%' . $request->inputbuscar . '%')
                ->orWhere('pro.producto', 'LIKE', '%' . $request->inputbuscar . '%')
                ->orWhere('pro.descripcion', 'LIKE', '%' . $request->inputbuscar . '%');
        })
        ->select('publicaciones.*')
        ->paginate(15);
        return view('vistas.frontend.paginas.resultados', compact('categorias', 'perfil','asociaciones','resultados','tiposDocumentos','departamentos'));

    }
}
