<?php

namespace App\Http\Controllers;

use App\Models\EquivalenciasUnidades;
use App\Models\Precios;
use App\Models\Publicaciones;
use App\Models\Productos;
use App\Models\Unidades;
use App\Models\Vendedores;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Auth;

class PublicacionesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('can:publicaciones.listar')->only('index');
        $this->middleware('can:publicaciones.guardar')->only('guardarPublicaciones');
        $this->middleware('can:publicaciones.actualizar')->only('actualizarPublicaciones');
        $this->middleware('can:publicaciones.eliminar')->only('eliminarPublicaciones');
    }

    public function index(Request $request)
    {
        $productos = Productos::all();
        $unidades = Unidades::all();
        $vendedores = Vendedores::all();
        $equivalencias_unidades = EquivalenciasUnidades::all();

        if ($request->ajax()) {
            return DataTables::of(Publicaciones::with('productos', 'unidades', 'vendedores', 'equivalencias_unidades')->where(['estado' => 1, 'vendedores_id' => Auth::user()->idvendedor])->get())->addIndexColumn()
                ->addColumn('action', function ($data) {
                    $btn = "";
                    if (Auth::user()->can('publicaciones.actualizar')) {
                        $btn = '<button type="button"  class="editbutton btn btn-success" style="color:white" onclick="buscarId(' . $data->id . ',1)" data-bs-toggle="modal"
                        data-bs-target="#modalGuardarForm"><i class="fa-solid fa-pencil"></i></button>';
                    }
                    if (Auth::user()->can('publicaciones.eliminar')) {
                        $btn .= "&nbsp";
                        $btn .= '<button type="button"  class="deletebutton btn btn-danger" onclick="buscarId(' . $data->id . ',2)"><i class="fas fa-trash"></i></button>';
                    }
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('vistas.backend.publicaciones.publicaciones', compact('productos', 'unidades', 'vendedores', 'equivalencias_unidades',));
    }

    public function peticionesAction(Request $request)
    {
        $GUARDAR_PUBLICACIONES = 1;
        $ACTUALIZAR_PUBLICACIONES = 2;
        $ELIMINAR_PUBLICACIONES = 3;
        $BUSCAR_PRECIOS = 4;
        try {
            // buscar 001
            // crear 002
            // editar 003
            // eliminar 004
            switch ($request->accion) {
                case $GUARDAR_PUBLICACIONES:
                    $respuesta = $this->guardarPublicaciones($request->all());
                    return $respuesta;
                    break;
                case $ACTUALIZAR_PUBLICACIONES:
                    $respuesta = $this->actualizarPublicaciones($request->all());
                    return $respuesta;
                    break;
                case $ELIMINAR_PUBLICACIONES:
                    $respuesta = $this->eliminarProductos($request->all());
                    return $respuesta;
                    break;
                case $BUSCAR_PRECIOS:
                    $listaPrecios = $this->buscarPrecios($request->all());
                    return $listaPrecios;
                    break;
            }
        } catch (\Exception $e) {
            $respuesta = array(
                'mensaje'      => $e->getMessage(),
                'estado'      => 0,
            );
            return $respuesta;
        }
    }




    public function buscarPrecios($datos)
    {
        $idAsociacionVendedor = Auth::user()->vendedor->id_asociacion;
        $listaPrecios = Precios::with('unidades')->where('producto_id', $datos['idproductos'])
            ->where('id_asociacion', $idAsociacionVendedor)
            ->get();

        // \Log::info($listaPrecios);
        return $listaPrecios;
    }
}
