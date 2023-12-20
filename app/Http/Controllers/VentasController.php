<?php

namespace App\Http\Controllers;

use App\Models\Clientes;
use App\Models\Publicaciones;
use App\Models\Ventas;
use App\Models\DetalleVentas;
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
        // $this->middleware('can:ventas.listarActivas')->only('index');
        // $this->middleware('can:ventas.listarFinalizadas')->only('indexFinalizadas');
        // $this->middleware('can:ventas.listarCanceladas')->only('indexCanceladas');
        $this->middleware('can:ventas.finalizar')->only('finalizarVentas');
        $this->middleware('can:ventas.cancelar')->only('cancelarVentas');
        $this->middleware('can:ventas.eliminar')->only('eliminarVentas');
    }

    public function index(Request $request)
    {
        $clientes = Clientes::all();
        $publicaciones = Publicaciones::all();
        // $ventas = Ventas::all();
        $perfil = auth()->user();
        if ($request->ajax()) {
            // return DataTables::of(DetalleVentas::with('publicaciones', 'ventas', 'ventas.cliente', 'publicaciones.precios', 'publicaciones.productos', 'publicaciones.unidades',)
            return DataTables::of(Ventas::with('publicaciones', 'cliente', 'publicaciones.precios', 'publicaciones.productos', 'publicaciones.unidades',)
                ->where(['estado' => 1, 'id_usuario' => Auth::user()->id])
                ->get())->addIndexColumn()
                ->addColumn('action', function ($data) {
                    $btn = "";
                    if (Auth::user()->can('ventas.finalizar')) {
                        $btn = '<button type="button"  class="editbutton btn btn-success" style="color:white" onclick="buscarId(' . $data->id . ',1)">
                        <span class="text">Finalizar venta</span>
                        </button>
                        <br>';
                    }
                    if (Auth::user()->can('ventas.cancelar')) {
                        $btn .= "&nbsp";
                        $btn .= '<button type="button"  class="deletebutton btn btn-danger" onclick="buscarId(' . $data->id . ',2)">
                        <span class="text">Cancelar venta</span>
                        </button>';
                    }
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('vistas.backend.ventas.misventas', compact('publicaciones', 'clientes', 'perfil'));
    }



    public function peticionesAction(Request $request)
    {
        $FINALIZAR_VENTA = 1;
        $CANCELAR_VENTA = 2;
        try {
            // estados de venta
            // activa - 1
            // finalizada - 2
            // cancelada - 3
            switch ($request->accion) {
                case $FINALIZAR_VENTA:
                    $respuesta = $this->finalizarVentas($request->all());
                    return $respuesta;
                    break;
                case $CANCELAR_VENTA:
                    $respuesta = $this->cancelarVentas($request->all());
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

    public function finalizarVentas($datos)
    {
        // $aErrores = array();
        DB::beginTransaction();
        try {
            $actualizarVenta = Ventas::findOrFail($datos['id']);
            $actualizarVenta->estado = 2;
            $actualizarVenta->save();

            DB::commit();
            $respuesta = array(
                'mensaje'      => "",
                'estado'      => 1,
            );
            return response()->json($respuesta);
        } catch (\Exception $e) {
            DB::rollback();
            throw  $e;
        }
    }

    public function cancelarVentas($datos)
    {
        $aErrores = array();
        DB::beginTransaction();
        try {
            $actualizarVenta = Ventas::findOrFail($datos['id']);
            $actualizarVenta->estado = 3;
            $actualizarVenta->save();

            DB::commit();
            $respuesta = array(
                'mensaje'      => "",
                'estado'      => 1,
            );
            return response()->json($respuesta);
        } catch (\Exception $e) {
            DB::rollback();
            throw  $e;
        }
    }
}
