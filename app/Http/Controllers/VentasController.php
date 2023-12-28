<?php

namespace App\Http\Controllers;

use App\Models\Clientes;
use App\Models\Publicaciones;
use App\Models\Ventas;
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
        $this->middleware('can:ventas.listarFinalizadas')->only('indexFinalizadas');
        $this->middleware('can:ventas.listarCanceladas')->only('indexCanceladas');
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


    public function indexFinalizadas(Request $request)
    {
        $clientes = Clientes::all();
        $publicaciones = Publicaciones::all();
        $perfil = auth()->user();
        if ($request->ajax()) {

            return DataTables::of(Ventas::with('publicaciones', 'cliente', 'publicaciones.precios', 'publicaciones.productos', 'publicaciones.unidades',)
                ->where(['estado' => 2, 'id_usuario' => Auth::user()->id])
                ->get())->addIndexColumn()
                ->make(true);
        }
        return view('vistas.backend.ventas.ventasfinalizadas', compact('publicaciones', 'clientes', 'perfil'));
    }

    public function indexCanceladas(Request $request)
    {
        $clientes = Clientes::all();
        $publicaciones = Publicaciones::all();
        // $ventas = Ventas::all();
        $perfil = auth()->user();
        if ($request->ajax()) {
            // return DataTables::of(DetalleVentas::with('publicaciones', 'ventas', 'ventas.cliente', 'publicaciones.precios', 'publicaciones.productos', 'publicaciones.unidades',)
            return DataTables::of(Ventas::with('publicaciones', 'cliente', 'publicaciones.precios', 'publicaciones.productos', 'publicaciones.unidades',)
                ->where(['estado' => 3, 'id_usuario' => Auth::user()->id])
                ->get())->addIndexColumn()
                ->make(true);
        }
        return view('vistas.backend.ventas.ventascanceladas', compact('publicaciones', 'clientes', 'perfil'));
    }

    public function peticionesAction(Request $request)
    {
        $FINALIZAR_VENTA = 1;
        $CANCELAR_VENTA = 2;
        $REGISTRAR_VENTA = 3;
        $TOTAL_VENTAS_FINALIZADAS_SIN_FECHAS = 4;
        $TOTAL_VENTAS_FINALIZADAS = 5;
        $VENTA_ENTRE_FECHAS = 6;
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
                case $REGISTRAR_VENTA:
                    $respuesta = $this->registrarVentas($request->all());
                    return $respuesta;
                    break;
                case $TOTAL_VENTAS_FINALIZADAS_SIN_FECHAS:
                    $respuesta = $this->totalVentasFinalizadasSinFechas();
                    return $respuesta;
                    break;
                case $TOTAL_VENTAS_FINALIZADAS:
                    $respuesta = $this->totalVentasFinalizadas($request->all());
                    return $respuesta;
                    break;
                case $VENTA_ENTRE_FECHAS:
                    $respuesta = $this->ventasEntreFechas($request->all());
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
    public function registrarVentas($datos)
    {
        // dd($datos);
        $aErrores = array();
        DB::beginTransaction();
        if ($datos['idpublicacion'] == "") {
            $aErrores[] = '- Falta identificador de la publicación';
        }
        if ($datos['idcliente'] == "") {
            $aErrores[] = '-Falta identificador del cliente';
        }
        if ($datos['cantidad'] == "") {
            $aErrores[] = '- Falta la cantidad a comprar';
        }
        if (count($aErrores) > 0) {
            throw new \Exception(join('</br>', $aErrores));
        }
        try {
            $vPrecio = Publicaciones::with('precios')->findOrFail($datos['idpublicacion']);
            $nuevaVenta = new Ventas();
            $nuevaVenta->fecha_venta = \Carbon\Carbon::now()->format('Ymd');
            $nuevaVenta->idcliente = $datos['idcliente'];
            $nuevaVenta->iva = 0;
            $nuevaVenta->id_usuario =  $datos['idvendedor'];
            $nuevaVenta->publicaciones_id = $datos['idpublicacion'];
            $nuevaVenta->cantidad = $datos['cantidad'];
            $nuevaVenta->precio_subtotal = floatval($vPrecio->precios->precio) * floatval($datos['cantidad']);
            $nuevaVenta->estado = 1;
            $nuevaVenta->created_at = \Carbon\Carbon::now();
            $nuevaVenta->updated_at = \Carbon\Carbon::now();
            $nuevaVenta->save();
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

    public function totalVentasFinalizadasSinFechas()
    {
        $totalVentas = Ventas::where(['estado' => 2, 'id_usuario' => Auth::user()->id])->sum('precio_subtotal');

        return response()->json(['totalVentas' => $totalVentas]);
    }

    public function totalVentasFinalizadas($datos)
    {
        $totalVentas = Ventas::where(['estado' => 2, 'id_usuario' => Auth::user()->id])
            ->whereBetween('fecha_venta', [$datos['fecha_inicio'], $datos['fecha_fin']])
            ->sum('precio_subtotal');

        return response()->json(['totalVentas' => $totalVentas]);
    }

    public function ventasEntreFechas($datos)
    {
        $ventas = Ventas::with('publicaciones', 'cliente', 'publicaciones.precios', 'publicaciones.productos', 'publicaciones.unidades',)
            ->whereBetween('fecha_venta', [$datos['fecha_inicio'], $datos['fecha_fin']])
            ->where(['estado' => 2, 'id_usuario' => Auth::user()->id])
            ->get();
        return response()->json(['ventas' => $ventas]);
    }
}
