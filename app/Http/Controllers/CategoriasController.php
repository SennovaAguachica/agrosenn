<?php

namespace App\Http\Controllers;

use App\Models\Categorias;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Auth;

class CategoriasController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('can:categorias.listar')->only('index');
        $this->middleware('can:categorias.guardar')->only('guardarCategorias');
        $this->middleware('can:categorias.actualizar')->only('actualizarCategorias');
        $this->middleware('can:categorias.eliminar')->only('eliminarCategorias');
    }
    public function index(Request $request)
    {
        $perfil = auth()->user();
        if ($request->ajax()) {
            return DataTables::of(Categorias::where('estado', 1)->get())->addIndexColumn()
                ->addColumn('action', function ($data) {
                    $btn = "";
                    if (Auth::user()->can('categorias.actualizar')) {
                        $btn = '<button type="button"  class="editbutton btn btn-success" style="color:white" onclick="buscarId(' . $data->id . ',1)" data-bs-toggle="modal"
                        data-bs-target="#modalGuardarForm"><i class="fa-solid fa-pencil"></i></button>';
                    }
                    if (Auth::user()->can('categorias.eliminar')) {
                        $btn .= "&nbsp";
                        $btn .= '<button type="button"  class="deletebutton btn btn-danger" onclick="buscarId(' . $data->id . ',2)"><i class="fas fa-trash"></i></button>';
                    }
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('vistas.backend.categorias.categorias',compact('perfil'));
    }
    public function peticionesAction(Request $request)
    {
        $GUARDAR_CATEGORIAS = 1;
        $ACTUALIZAR_CATEGORIAS = 2;
        $ELIMINAR_CATEGORIAS = 3;
        try {
            // buscar 001
            // crear 002
            // editar 003
            // eliminar 004
            switch ($request->accion) {
                case $GUARDAR_CATEGORIAS:
                    $respuesta = $this->guardarCategorias($request->all());
                    return $respuesta;
                    break;
                case $ACTUALIZAR_CATEGORIAS:
                    $respuesta = $this->actualizarCategorias($request->all());
                    return $respuesta;
                    break;
                case $ELIMINAR_CATEGORIAS:
                    $respuesta = $this->eliminarCategorias($request->all());
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
    public function guardarCategorias($datos)
    {
        // dd($datos);
        $aErrores = array();
        DB::beginTransaction();
        if ($datos['categoria'] == "") {
            $aErrores[] = '- Diligencie el nombre de la categoria';
        }
        if ($datos['imagen'] == "") {
            $aErrores[] = '- Escoja la imagen de la categoria';
        }
        if (count($aErrores) > 0) {
            throw new \Exception(join('</br>', $aErrores));
        }
        try {

            $validacion = Categorias::where([
                ['categoria', $datos['categoria']],
                ['estado', 0]
            ])->first();
            if ($validacion) {
                $validacion->update(['estado' => 1]);
            } else {
                $nuevoCategoria = new Categorias();
                $nuevoCategoria->categoria = $datos['categoria'];
                $nuevoCategoria->descripcion = $datos['descripcion'];
                //$fileName  = time() . $datos['imagen']->getClientOriginalName();
                $imagen = Storage::disk('public')->put('/categorias', $datos['imagen']);
                $urlImagen = Storage::url($imagen);
                $icono = Storage::disk('public')->put('/categorias', $datos['icono']);
                $urlIcono = Storage::url($icono);
                $nuevoCategoria->imagen = $urlImagen;
                $nuevoCategoria->icono = $urlIcono;
                $nuevoCategoria->estado = 1;
                $nuevoCategoria->created_at = \Carbon\Carbon::now();
                $nuevoCategoria->updated_at = \Carbon\Carbon::now();
                $nuevoCategoria->save();
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
    public function actualizarCategorias($datos)
    {
        $aErrores = array();
        DB::beginTransaction();
        if ($datos['categoria'] == "") {
            $aErrores[] = '- Diligencie el nombre de la categoria';
        }
        if (count($aErrores) > 0) {
            throw new \Exception(join('</br>', $aErrores));
        }
        try {
            $actualizarCategoria = Categorias::findOrFail($datos['id']);;
            $actualizarCategoria->categoria = $datos['categoria'];
            $actualizarCategoria->descripcion = $datos['descripcion'];
            if (!empty($datos['imagen'])) {
                if ($datos['imagen'] != null) {
                    //existe un archivo cargado?
                    if (Storage::exists($actualizarCategoria->imagen)) {
                        // aquí la borro
                        Storage::delete($actualizarCategoria->imagen);
                    }
                    //guardo el archivo nuevo
                    $imagen = Storage::disk('public')->put('/categorias', $datos['imagen']);
                    $url = Storage::url($imagen);
                }
                $actualizarCategoria->imagen = $url;
            }

            if (!empty($datos['icono'])) {
                if ($datos['icono'] != null) {
                    //existe un archivo cargado?
                    if (Storage::exists($actualizarCategoria->icono)) {
                        // aquí la borro
                        Storage::delete($actualizarCategoria->icono);
                    }
                    //guardo el archivo nuevo
                    $icono = Storage::disk('public')->put('/categorias', $datos['icono']);
                    $urlIcono = Storage::url($icono);
                }
                $actualizarCategoria->icono = $urlIcono;
            }
            $actualizarCategoria->save();

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
    public function eliminarCategorias($datos)
    {
        //dd($datos['id']);
        $aErrores = array();
        DB::beginTransaction();
        if ($datos['id'] == "") {
            $aErrores[] = '- No existe categoria a eliminar';
        }
        if (count($aErrores) > 0) {
            throw new \Exception(join('</br>', $aErrores));
        }
        try {
            $eliminarCategoria = Categorias::findOrFail($datos['id']);
            $eliminarCategoria->update(['estado' => 0]);
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
