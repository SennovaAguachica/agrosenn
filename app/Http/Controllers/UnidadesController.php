<?php

namespace App\Http\Controllers;

use App\Models\Unidades;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Auth;

class UnidadesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('can:unidades.listar')->only('index');
        $this->middleware('can:unidades.guardar')->only('guardarUnidades');
        $this->middleware('can:unidades.actualizar')->only('actualizarUnidades');
        $this->middleware('can:unidades.eliminar')->only('eliminarUnidades');
    }
    public function index(Request $request)
    {
        if ($request->ajax()) {
            return DataTables::of(Unidades::where('estado', 1)->get())->addIndexColumn()
                ->addColumn('action', function ($data) {
                    $btn = "";
                    if (Auth::user()->can('unidades.actualizar')) {
                        $btn = '<button type="button"  class="editbutton btn btn-success" style="color:white" onclick="buscarId(' . $data->id . ',1)" data-bs-toggle="modal"
                        data-bs-target="#modalGuardarForm"><i class="fa-solid fa-pencil"></i></button>';
                    }
                    if (Auth::user()->can('unidades.eliminar')) {
                        $btn .= "&nbsp";
                        $btn .= '<button type="button"  class="deletebutton btn btn-danger" onclick="buscarId(' . $data->id . ',2)"><i class="fas fa-trash"></i></button>';
                    }
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('vistas.backend.unidades.unidades');
    }

    public function peticionesAction(Request $request)
    {
        $GUARDAR_UNIDADES = 1;
        $ACTUALIZAR_UNIDADES = 2;
        $ELIMINAR_UNIDADES = 3;
        try {
            // buscar 001
            // crear 002
            // editar 003
            // eliminar 004
            switch ($request->accion) {
                case $GUARDAR_UNIDADES:
                    $respuesta = $this->guardarUnidades($request->all());
                    return $respuesta;
                    break;
                case $ACTUALIZAR_UNIDADES:
                    $respuesta = $this->actualizarUnidades($request->all());
                    return $respuesta;
                    break;
                case $ELIMINAR_UNIDADES:
                    $respuesta = $this->eliminarUnidades($request->all());
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

    public function guardarUnidades($datos)
    {
        // dd($datos);
        $aErrores = array();
        DB::beginTransaction();
        if ($datos['unidad'] == "") {
            $aErrores[] = '- Diligencie el nombre de la unidad';
        }
        if ($datos['abreviatura'] == "") {
            $aErrores[] = '- Escoja la abreviatura de la unidad';
        }
        if (count($aErrores) > 0) {
            throw new \Exception(join('</br>', $aErrores));
        }
        try {

            $validacion = Unidades::where([
                ['unidad', $datos['unidad']],
                ['estado', 0]
            ])->first();
            if ($validacion) {
                $validacion->update(['estado' => 1]);
            } else {
                $nuevoUnidad = new Unidades();
                $nuevoUnidad->unidad = $datos['unidad'];
                $nuevoUnidad->abreviatura = $datos['abreviatura'];
                $nuevoUnidad->descripcion = $datos['descripcion'];
                $nuevoUnidad->estado = 1;
                $nuevoUnidad->created_at = \Carbon\Carbon::now();
                $nuevoUnidad->updated_at = \Carbon\Carbon::now();
                $nuevoUnidad->save();
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

    public function actualizarUnidades($datos)
    {
        $aErrores = array();
        DB::beginTransaction();
        if ($datos['unidad'] == "") {
            $aErrores[] = '- Diligencie el nombre de la unidad';
        }
        if ($datos['abreviatura'] == "") {
            $aErrores[] = '- Diligencie las siglas de la abreviatura';
        }
        if (count($aErrores) > 0) {
            throw new \Exception(join('</br>', $aErrores));
        }
        try {
            $actualizarUnidad = Unidades::findOrFail($datos['id']);;
            $actualizarUnidad->unidad = $datos['unidad'];
            $actualizarUnidad->abreviatura = $datos['abreviatura'];
            $actualizarUnidad->descripcion = $datos['descripcion'];
            $actualizarUnidad->save();

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

    public function eliminarUnidades($datos)
    {
        //dd($datos['id']);
        $aErrores = array();
        DB::beginTransaction();
        if ($datos['id'] == "") {
            $aErrores[] = '- No existe la unidad a eliminar';
        }
        if (count($aErrores) > 0) {
            throw new \Exception(join('</br>', $aErrores));
        }
        try {
            $eliminarUnidad = Unidades::findOrFail($datos['id']);
            $eliminarUnidad->update(['estado' => 0]);
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
