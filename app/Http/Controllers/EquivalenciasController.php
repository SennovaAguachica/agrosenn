<?php

namespace App\Http\Controllers;

use App\Models\Unidades;
use App\Models\Equivalencias;
use App\Models\EquivalenciasUnidades;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Auth;

class EquivalenciasController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('can:equivalencias.listar')->only('index');
        $this->middleware('can:equivalencias.guardar')->only('guardarEquivalencias');
        $this->middleware('can:equivalencias.actualizar')->only('actualizarEquivalencias');
        $this->middleware('can:equivalencias.eliminar')->only('eliminarEquivalencias');
    }
    public function index(Request $request)
    {
        $equivalencias = Equivalencias::all();
        $unidades = Unidades::all();
        if ($request->ajax()) {
            return DataTables::of(EquivalenciasUnidades::with('equivalencias', 'unidades')->where('estado', 1)->get())->addIndexColumn()
                ->addColumn('action', function ($data) {
                    $btn = "";
                    if (Auth::user()->can('equivalencias.actualizar')) {
                        $btn = '<button type="button"  class="editbutton btn btn-success" style="color:white" onclick="buscarId(' . $data->id . ',1)" data-bs-toggle="modal"
                        data-bs-target="#modalGuardarForm"><i class="fa-solid fa-pencil"></i></button>';
                    }
                    if (Auth::user()->can('equivalencias.eliminar')) {
                        $btn .= "&nbsp";
                        $btn .= '<button type="button"  class="deletebutton btn btn-danger" onclick="buscarId(' . $data->id . ',2)"><i class="fas fa-trash"></i></button>';
                    }
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('vistas.backend.equivalencias.equivalencias', compact('equivalencias', 'unidades'));
    }


    public function peticionesAction(Request $request)
    {
        $GUARDAR_EQUIVALENCIAS = 1;
        $ACTUALIZAR_EQUIVALENCIAS = 2;
        $ELIMINAR_EQUIVALENCIAS = 3;
        try {
            // buscar 001
            // crear 002
            // editar 003
            // eliminar 004
            switch ($request->accion) {
                case $GUARDAR_EQUIVALENCIAS:
                    $respuesta = $this->guardarEquivalencias($request->all());
                    return $respuesta;
                    break;
                case $ACTUALIZAR_EQUIVALENCIAS:
                    $respuesta = $this->actualizarEquivalencias($request->all());
                    return $respuesta;
                    break;
                case $ELIMINAR_EQUIVALENCIAS:
                    $respuesta = $this->eliminarEquivalencias($request->all());
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

    public function guardarEquivalencias($datos)
    {
        // dd($datos);
        $aErrores = array();
        DB::beginTransaction();
        if ($datos['idunidades'] == "") {
            $aErrores[] = '- Escoja la unidad a convertir';
        }
        if ($datos['idequivalencias'] == "") {
            $aErrores[] = '- Escoja la unidad minima';
        }
        if ($datos['equivalencia'] == "") {
            $aErrores[] = '- Digite el número correspondiente a la unidad mínima';
        }
        if (count($aErrores) > 0) {
            throw new \Exception(join('</br>', $aErrores));
        }
        try {

            $validacion = EquivalenciasUnidades::where([
                ['equivalencia', $datos['equivalencia']],
                ['equivalencias_id', $datos['idequivalencias']],
                ['unidades_id', $datos['idunidades']],
                ['estado', 0]
            ])->first();
            if ($validacion) {
                $validacion->update(['estado' => 1]);
            } else {
                $nuevoEquivalencia = new EquivalenciasUnidades();
                $nuevoEquivalencia->equivalencia = $datos['equivalencia'];
                $nuevoEquivalencia->equivalencias_id = $datos['idequivalencias'];
                $nuevoEquivalencia->unidades_id = $datos['idunidades'];
                $nuevoEquivalencia->estado = 1;
                $nuevoEquivalencia->created_at = \Carbon\Carbon::now();
                $nuevoEquivalencia->updated_at = \Carbon\Carbon::now();
                $nuevoEquivalencia->save();
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

    public function actualizarEquivalencias($datos)
    {
        $aErrores = array();
        DB::beginTransaction();
        if ($datos['idunidades'] == "") {
            $aErrores[] = '- Escoja la unidad a convertir';
        }
        if ($datos['idequivalencias'] == "") {
            $aErrores[] = '- Escoja la unidad minima';
        }
        if ($datos['equivalencia'] == "") {
            $aErrores[] = '- Digite el número correspondiente a la unidad mínima';
        }
        if (count($aErrores) > 0) {
            throw new \Exception(join('</br>', $aErrores));
        }
        try {
            $actualizarEquivalencia = EquivalenciasUnidades::findOrFail($datos['id']);;
            $actualizarEquivalencia->equivalencia = $datos['equivalencia'];
            $actualizarEquivalencia->equivalencias_id = $datos['idequivalencias'];
            $actualizarEquivalencia->unidades_id = $datos['idunidades'];
            $actualizarEquivalencia->save();

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

    public function eliminarEquivalencias($datos)
    {
        //dd($datos['id']);
        $aErrores = array();
        DB::beginTransaction();
        if ($datos['id'] == "") {
            $aErrores[] = '- No existe la equivalencia a eliminar';
        }
        if (count($aErrores) > 0) {
            throw new \Exception(join('</br>', $aErrores));
        }
        try {
            $eliminarEquivalencia = EquivalenciasUnidades::findOrFail($datos['id']);
            $eliminarEquivalencia->update(['estado' => 0]);
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
