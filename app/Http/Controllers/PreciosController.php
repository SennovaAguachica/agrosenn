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

class PreciosController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('can:precios.listar')->only('index');
        $this->middleware('can:sugeridos.listar')->only('indexsugeridos');
        $this->middleware('can:precios.guardar')->only('guardarPrecios');
        $this->middleware('can:precios.actualizar')->only('actualizarPrecios');
        $this->middleware('can:precios.eliminar')->only('eliminarPrecios');
    }

    public function index(Request $request)
    {
        $productos = Productos::all();
        $unidades = Unidades::all();
        $perfil = auth()->user();
        if ($request->ajax()) {
            // return DataTables::of(Precios::with('productos', 'unidades')->where(['estado' => 1, 'id_asociacion' => Auth::user()->idasociacion])->get())->addIndexColumn()
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

    public function indexsugeridos(Request $request)
    {
        $productos = Productos::all();
        $unidades = Unidades::all();
        $perfil = auth()->user();
        if ($request->ajax()) {


            $userID = Auth::user()->id;

            $vendedor = Vendedores::whereHas('usuario', function ($query) use ($userID) {
                $query->where('id', $userID);
            })->first();

            $id_asociacion = $vendedor->id_asociacion;
            $asociacionVendedor = Asociaciones::find($id_asociacion);
            $usuarioAsociado = $asociacionVendedor->usuario;
            $id_usuario_asociado = $usuarioAsociado->id;
            return DataTables::of(Precios::with('productos', 'unidades')->where(['estado' => 1, 'id_usuario' => $id_usuario_asociado])->get())->addIndexColumn()

                ->make(true);
        }


        return view('vistas.backend.precios.sugeridos', compact('productos', 'unidades', 'perfil'));
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

    public function guardarPrecios($datos)
    {

        $aErrores = array();
        DB::beginTransaction();
        if ($datos['precios_idunidades'] == "") {
            $aErrores[] = '- Escoja la unidad';
        }
        if ($datos['precios_idproductos'] == "") {
            $aErrores[] = '- Escoja el producto';
        }
        if ($datos['precios_precio'] == "") {
            $aErrores[] = '- Digite el precio del producto según la unidad';
        }
        if (count($aErrores) > 0) {
            throw new \Exception(join('</br>', $aErrores));
        }
        try {
            $idusuario = Auth::user()->id;
            $validacion = Precios::where([
                ['producto_id', $datos['precios_idproductos']],
                ['unidades_id', $datos['precios_idunidades']],
                ['id_usuario', $idusuario],
                ['estado', 0]
            ])->first();
            if ($validacion) {
                $validacion->update([
                    'precio' => $datos['precios_precio'],
                    'estado' => 1
                ]);
            } else {
                $validacionProducto = Precios::where([
                    ['producto_id', $datos['precios_idproductos']],
                    ['id_usuario', $idusuario],
                ])->get();
                $validacionUnidad = Precios::where([
                    ['unidades_id', $datos['precios_idunidades']],
                    ['id_usuario', $idusuario],
                ])->get();
                if (count($validacionProducto) > 0 && count($validacionUnidad) === 0) {
                    $aErrores[] = '- El precio de este producto ya está asignado a esta unidad';
                } else {
                    $nuevoPrecio = new Precios();
                    $nuevoPrecio->precio = $datos['precios_precio'];
                    $nuevoPrecio->producto_id = $datos['precios_idproductos'];
                    $nuevoPrecio->unidades_id = $datos['precios_idunidades'];
                    $nuevoPrecio->id_usuario = $idusuario;
                    $nuevoPrecio->estado = 1;
                    $nuevoPrecio->created_at = \Carbon\Carbon::now();
                    $nuevoPrecio->updated_at = \Carbon\Carbon::now();
                    $nuevoPrecio->save();
                }
            }

            if (count($aErrores) > 0) {
                $respuesta = array(
                    'mensaje'      => $aErrores,
                    'estado'      => 0,
                );
                return response()->json($respuesta);
            } else {
                DB::commit();
                $respuesta = array(
                    'mensaje'      => "",
                    'estado'      => 1,
                );
                return response()->json($respuesta);
            }
        } catch (\Exception $e) {
            DB::rollback();
            throw  $e;
        }
    }

    public function actualizarPrecios($datos)
    {
        $aErrores = array();
        DB::beginTransaction();
        if ($datos['precios_idunidades'] == "") {
            $aErrores[] = '- Escoja la unidad';
        }
        if ($datos['precios_idproductos'] == "") {
            $aErrores[] = '- Escoja el producto';
        }
        if ($datos['precios_precio'] == "") {
            $aErrores[] = '- Digite el precio del producto según la unidad';
        }
        if (count($aErrores) > 0) {
            throw new \Exception(join('</br>', $aErrores));
        }
        try {
            $actualizarPrecio = Precios::findOrFail($datos['id']);;
            $actualizarPrecio->precio = $datos['precios_precio'];
            $actualizarPrecio->producto_id = $datos['precios_idproductos'];
            $actualizarPrecio->unidades_id = $datos['precios_idunidades'];
            $actualizarPrecio->save();

            if (count($aErrores) > 0) {
                $respuesta = array(
                    'mensaje'      => $aErrores,
                    'estado'      => 0,
                );
                return response()->json($respuesta);
            } else {
                DB::commit();
                $respuesta = array(
                    'mensaje'      => "",
                    'estado'      => 1,
                );
                return response()->json($respuesta);
            }
        } catch (\Exception $e) {
            DB::rollback();
            throw  $e;
        }
    }

    public function eliminarPrecios($datos)
    {
        //dd($datos['id']);
        $aErrores = array();
        DB::beginTransaction();
        if ($datos['id'] == "") {
            $aErrores[] = '- No existe el precio a eliminar';
        }
        if (count($aErrores) > 0) {
            throw new \Exception(join('</br>', $aErrores));
        }
        try {
            $eliminarPrecio = Precios::findOrFail($datos['id']);
            $eliminarPrecio->update(['estado' => 0]);
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
