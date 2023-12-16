<?php

namespace App\Http\Controllers;

use App\Models\Precios;
use App\Models\Productos;
use App\Models\Unidades;
use App\Models\Vendedores;
use App\Models\Asociaciones;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
// use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Auth;

class VentasController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('can:ventas.listar')->only('index');
        $this->middleware('can:ventas.guardar')->only('guardarVentas');
        $this->middleware('can:ventas.actualizar')->only('actualizarVentas');
        $this->middleware('can:ventas.eliminar')->only('eliminarVentas');
    }

    public function index(Request $request)
    {
        $productos = Productos::all();
        $unidades = Unidades::all();
        $perfil = auth()->user();
        if ($request->ajax()) {
            return DataTables::of(Precios::with('productos', 'unidades')->where(['estado' => 1, 'id_usuario' => Auth::user()->id])->get())->addIndexColumn()
                ->addColumn('action', function ($data) {
                    $btn = "";
                    if (Auth::user()->can('precios.actualizar')) {
                        $btn = '<button type="button"  class="editbutton btn btn-success" style="color:white" onclick="buscarId(' . $data->id . ',1)" data-bs-toggle="modal"
                        data-bs-target="#modalGuardarForm"><i class="fa-solid fa-pencil"></i></button>';
                    }
                    if (Auth::user()->can('precios.eliminar')) {
                        $btn .= "&nbsp";
                        $btn .= '<button type="button"  class="deletebutton btn btn-danger" onclick="buscarId(' . $data->id . ',2)"><i class="fas fa-trash"></i></button>';
                    }
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('vistas.backend.precios.precios', compact('productos', 'unidades', 'perfil'));
    }



    public function peticionesAction(Request $request)
    {
        $GUARDAR_PRECIOS = 1;
        $ACTUALIZAR_PRECIOS = 2;
        $ELIMINAR_PRECIOS = 3;
        try {
            // buscar 001
            // crear 002
            // editar 003
            // eliminar 004
            switch ($request->accion) {
                case $GUARDAR_PRECIOS:
                    $respuesta = $this->guardarPrecios($request->all());
                    return $respuesta;
                    break;
                case $ACTUALIZAR_PRECIOS:
                    $respuesta = $this->actualizarPrecios($request->all());
                    return $respuesta;
                    break;
                case $ELIMINAR_PRECIOS:
                    $respuesta = $this->eliminarPrecios($request->all());
                    return $respuesta;
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
}
