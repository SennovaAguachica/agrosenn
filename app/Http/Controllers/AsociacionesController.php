<?php

namespace App\Http\Controllers;

use App\Models\Asociaciones;
use App\Models\Departamentos;
use App\Models\Ciudades;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Auth;

class AsociacionesController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
        $this->middleware('can:asociaciones.listar')->only('index');
        $this->middleware('can:asociaciones.guardar')->only('guardarAsociaciones');
        $this->middleware('can:asociaciones.actualizar')->only('actualizarAsociaciones');
        $this->middleware('can:asociaciones.eliminar')->only('eliminarAsociaciones');
    }
    public function index(Request $request)
    {
        $departamentos = Departamentos::all();
        $perfil = auth()->user();
        if ($request->ajax()) {
            return DataTables::of(Asociaciones::with('municipio.departamento')->get())->addIndexColumn()
                ->addColumn('action', function ($data) {
                    $btn = "";
                    if($data->estado == 1 && Auth::user()->can('asociaciones.actualizar')){
                        $btn = '<button type="button"  class="editbutton btn btn-success" style="color:white" onclick="buscarId(' . $data->id . ',1)" data-bs-toggle="modal"
                        data-bs-target="#modalGuardarForm"><i class="fa-solid fa-pencil"></i></button>';
                    }
                    if($data->estado == 1 && Auth::user()->can('asociaciones.eliminar')){
                        $btn .= "&nbsp";
                        $btn .= '<button type="button"  class="deletebutton btn btn-danger" onclick="buscarId(' . $data->id . ',2)"><i class="fas fa-trash"></i></button>';
                    }
                    if($data->estado == 0 && Auth::user()->can('asociaciones.habilitar')){
                        $btn .= "&nbsp";
                        $btn .= '<button type="button"  class="habilitarbutton btn btn-primary" onclick="buscarId(' . $data->id . ',3)"><i class="fas fa-angle-double-up"></i> Habilitar</button>';
                    }
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('vistas.backend.asociaciones.asociaciones', compact('departamentos','perfil'));
    }
    public function peticionesAction(Request $request)
    {
        $GUARDAR_ASOCIACIONES = 1;
        $ACTUALIZAR_ASOCIACIONES = 2;
        $ELIMINAR_ASOCIACIONES = 3;
        $BUSCAR_MUNICIPIOS = 4;
        $HABILITAR_ASOCIACION = 5;
        try {
            // buscar 001
            // crear 002
            // editar 003
            // eliminar 004
            switch ($request->accion) {
                case $GUARDAR_ASOCIACIONES:
                    $respuesta = $this->guardarAsociaciones($request->all());
                    return $respuesta;
                    break;
                case $ACTUALIZAR_ASOCIACIONES:
                    $respuesta = $this->actualizarAsociaciones($request->all());
                    return $respuesta;
                    break;
                case $ELIMINAR_ASOCIACIONES:
                    $respuesta = $this->eliminarAsociaciones($request->all());
                    return $respuesta;
                    break;
                case $BUSCAR_MUNICIPIOS:
                    $municipios = $this->buscarMunicipios($request->all());
                    return $municipios;
                    break;
                case $HABILITAR_ASOCIACION:
                    $respuesta = $this->habilitarAsociacion($request->all());
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
    public function guardarAsociaciones($datos)
    {
        // dd($datos);
        $aErrores = array();
        DB::beginTransaction();
        if ($datos['asociacion'] == "" && $datos['codigoasociacion'] == "" && $datos['direccion'] == "" && $datos['celular'] == "" && $datos['email'] == "" && $datos['idmunicipio'] == "") {
            $aErrores[] = '- Faltan datos necesarios';
        }
        $validacion = Asociaciones::where([
            ['codigo_asociacion', $datos['codigoasociacion']]
        ])->get();
        $validacionUser = User::where([
            ['documento', $datos['codigoasociacion']]
        ])->get();
        if (count($validacion) > 0 || count($validacionUser) > 0) {
            $aErrores[] = '- El codigo de asociación ya se encuentra registrado';
        }
        $validacionCorreo = Asociaciones::where([
            ['email', $datos['email']]
        ])->get();
        $validacionCorreoUser = User::where([
            ['email', $datos['email']]
        ])->get();
        if (count($validacionCorreo) > 0 || count($validacionCorreoUser) > 0) {
            $aErrores[] = '- El correo ya se encuentra registrado';
        }
        if (count($aErrores) > 0) {
            throw new \Exception(join('</br>', $aErrores));
        }
        try {
            $nuevoAsociacion = new Asociaciones();
            $nuevoAsociacion->asociacion = $datos['asociacion'];
            $nuevoAsociacion->codigo_asociacion = $datos['codigoasociacion'];
            $nuevoAsociacion->n_celular = $datos['celular'];
            $nuevoAsociacion->direccion = $datos['direccion'];
            $nuevoAsociacion->email = $datos['email'];
            $nuevoAsociacion->id_municipio = $datos['idmunicipio'];
            $nuevoAsociacion->estado = 1;
            $nuevoAsociacion->created_at = \Carbon\Carbon::now();
            $nuevoAsociacion->updated_at = \Carbon\Carbon::now();
            $nuevoAsociacion->save();
            //Obtener el id asociacion del ultimo registro
            $ultimoInsertado = Asociaciones::latest('id')->first();
            
            $nuevoUsuario = new User();
            $nuevoUsuario->idrol = 2;
            $nuevoUsuario->idasociacion = $ultimoInsertado->id;
            $nuevoUsuario->documento = $datos['codigoasociacion'];
            $nuevoUsuario->email = $datos['email'];
            $nuevoUsuario->password = Hash::make($datos['codigoasociacion']);
            $nuevoUsuario->estado = 1;
            $nuevoUsuario->save();
            $nuevoUsuario->roles()->sync(2);
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
    public function actualizarAsociaciones($datos)
    {
        $aErrores = array();
        DB::beginTransaction();
        if ($datos['asociacion'] == "" && $datos['codigoasociacion'] == "" && $datos['direccion'] == "" && $datos['celular'] == "" && $datos['email'] == "" && $datos['idmunicipio'] == "") {
            $aErrores[] = '- Faltan datos necesarios';
        }
        $validacion = Asociaciones::where([
            ['codigo_asociacion', $datos['codigoasociacion']]
        ])->where('id', '!=', $datos['id'])->get();

        if (count($validacion) > 0) {
            $aErrores[] = '- El asociacion ya se encuentra registrada';
        }
        $validacionCorreo = Asociaciones::where([
            ['email', $datos['email']]
        ])->where('id', '!=', $datos['id'])->get();
        $validacionCorreoUser = User::where([
            ['email', $datos['email']]
        ])->where('idasociacion', '!=', $datos['id'])->get();
        if (count($validacionCorreo) > 0 || count($validacionCorreoUser) > 0) {
            $aErrores[] = '- El correo ya se encuentra registrado';
        }
        if (count($aErrores) > 0) {
            throw new \Exception(join('</br>', $aErrores));
        }
        try {
            $actualizarAsociacion = Asociaciones::with('usuario')->findOrFail($datos['id']);;
            $actualizarAsociacion->asociacion = $datos['asociacion'];
            $actualizarAsociacion->codigo_asociacion = $datos['codigoasociacion'];
            $actualizarAsociacion->direccion = $datos['direccion'];
            $actualizarAsociacion->n_celular = $datos['celular'];
            if($actualizarAsociacion->email != $datos['email'] || $actualizarAsociacion->codigo_asociacion != $datos['codigoasociacion']){
                $actualizarAsociacion->usuario->documento = $datos['codigoasociacion'];
                $actualizarAsociacion->usuario->email = $datos['email'];
                $actualizarAsociacion->usuario->save();
            }
            $actualizarAsociacion->email = $datos['email'];
            $actualizarAsociacion->save();
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
    public function eliminarAsociaciones($datos)
    {
        $aErrores = array();
        DB::beginTransaction();
        if ($datos['id'] == "") {
            $aErrores[] = '- No existe asociación a eliminar';
        }
        if (count($aErrores) > 0) {
            throw new \Exception(join('</br>', $aErrores));
        }
        try {
            $eliminarAsociacion = Asociaciones::with('usuario')->findOrFail($datos['id']);
            $eliminarAsociacion->update(['estado' => '0']);
            if($eliminarAsociacion->usuario){
                $eliminarAsociacion->usuario->update(['estado' => '0']);
            }
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
    public function habilitarAsociacion($datos)
    {
        $aErrores = array();
        DB::beginTransaction();
        if ($datos['id'] == "") {
            $aErrores[] = '- No existe asociación a habilitar';
        }
        if (count($aErrores) > 0) {
            throw new \Exception(join('</br>', $aErrores));
        }
        try {
            $habilitarAsociacion = Asociaciones::findOrFail($datos['id']);
            $habilitarAsociacion->update(['estado' => '1']);
            if($habilitarAsociacion->usuario){
                $habilitarAsociacion->usuario->update(['estado' => '1']);
            }
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
    public function buscarMunicipios($datos)
    {
        $municipios = Ciudades::where('iddepartamentos', $datos['iddepartamento'])->get();
        return $municipios;
    }
}
