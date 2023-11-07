<?php

namespace App\Http\Controllers;

use App\Models\Administradores;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Auth;

class AdministradoresController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
        //Validacion permisos administradores
        $this->middleware('can:administradores.listar')->only('index');
        $this->middleware('can:administradores.guardar')->only('guardarAdministradores');
        $this->middleware('can:administradores.actualizar')->only('actualizarAdministradores');
        $this->middleware('can:administradores.eliminar')->only('eliminarAdministradores');
    }
    public function index(Request $request)
    {
        if ($request->ajax()) {
            return DataTables::of(Administradores::where('id', '!=', auth()->id())->get())->addIndexColumn()
                ->addColumn('action', function ($data) {
                    $btn = "";
                    if(Auth::user()->can('administradores.actualizar')){
                            $btn = '<button type="button"  class="editbutton btn btn-success" style="color:white" onclick="buscarId(' . $data->id . ',1)" data-bs-toggle="modal"
                        data-bs-target="#modalGuardarForm"><i class="fa-solid fa-pencil"></i></button>';
                    }
                    if(Auth::user()->can('administradores.eliminar')){
                        $btn .= "&nbsp";
                        $btn .= '<button type="button"  class="deletebutton btn btn-danger" onclick="buscarId(' . $data->id . ',2)"><i class="fas fa-trash"></i></button>';
                    }
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('vistas.backend.administradores.administradores');
    }
    public function peticionesAction(Request $request)
    {
        $GUARDAR_ADMINISTRADORES = 1;
        $ACTUALIZAR_ADMINISTRADORES = 2;
        $ELIMINAR_ADMINISTRADORES = 3;
        $BUSCAR_MUNICIPIOS = 4;
        try {
            // buscar 001
            // crear 002
            // editar 003
            // eliminar 004
            switch ($request->accion) {
                case $GUARDAR_ADMINISTRADORES:
                    $respuesta = $this->guardarAdministradores($request->all());
                    return $respuesta;
                    break;
                case $ACTUALIZAR_ADMINISTRADORES:
                    $respuesta = $this->actualizarAdministradores($request->all());
                    return $respuesta;
                    break;
                case $ELIMINAR_ADMINISTRADORES:
                    $respuesta = $this->eliminarAdministradores($request->all());
                    return $respuesta;
                    break;
                case $BUSCAR_MUNICIPIOS:
                    $municipios = $this->buscarMunicipios($request->all());
                    return $municipios;
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
    public function guardarAdministradores($datos)
    {
        // dd($datos);
        $aErrores = array();
        DB::beginTransaction();
        if ($datos['administrador'] == "" && $datos['codigoadministrador'] == "" && $datos['direccion'] == "" && $datos['celular'] == "" && $datos['email'] == "" && $datos['idmunicipio'] == "") {
            $aErrores[] = '- Faltan datos necesarios';
        }
        $validacion = Administradores::where([
            ['codigo_administrador', $datos['codigoadministrador']]
        ])->get();
        if (count($validacion) > 0) {
            $aErrores[] = '- El administrador ya se encuentra registrado';
        }
        $validacionCorreo = Administradores::where([
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
            $nuevoAdministrador = new Administradores();
            $nuevoAdministrador->administrador = $datos['administrador'];
            $nuevoAdministrador->codigo_administrador = $datos['codigoadministrador'];
            $nuevoAdministrador->n_celular = $datos['celular'];
            $nuevoAdministrador->email = $datos['email'];
            $nuevoAdministrador->created_at = \Carbon\Carbon::now();
            $nuevoAdministrador->updated_at = \Carbon\Carbon::now();
            $nuevoAdministrador->save();
            //Obtener el id administrador del ultimo registro
            $ultimoInsertado = Administradores::latest('id')->first();
            
            $nuevoUsuario = new User();
            $nuevoUsuario->idrol = 1;
            $nuevoUsuario->idadministrador = $ultimoInsertado->id;
            $nuevoUsuario->documento = $datos['codigoadministrador'];
            $nuevoUsuario->email = $datos['email'];
            $nuevoUsuario->password = Hash::make($datos['codigoadministrador']);
            $nuevoUsuario->estado = 1;
            $nuevoUsuario->save();
            $nuevoUsuario->roles()->sync(1);
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
    public function actualizarAdministradores($datos)
    {
        $aErrores = array();
        DB::beginTransaction();
        if ($datos['administrador'] == "" && $datos['codigoadministrador'] == "" && $datos['direccion'] == "" && $datos['celular'] == "" && $datos['email'] == "" && $datos['idmunicipio'] == "") {
            $aErrores[] = '- Faltan datos necesarios';
        }
        $validacion = Administradores::where([
            ['codigo_administrador', $datos['codigoadministrador']]
        ])->where('id', '!=', $datos['id'])->get();
        $validacionUser = User::where([
            ['documento', $datos['codigoadministrador']]
        ])->get();
        if (count($validacion) > 0 || count($validacionUser) > 0) {
            $aErrores[] = '- El administrador o el usuario ya se encuentra registrado';
        }
        $validacionCorreo = Administradores::where([
            ['email', $datos['email']]
        ])->where('id', '!=', $datos['id'])->get();
        $validacionCorreoUser = User::where([
            ['email', $datos['email']]
        ])->where('idadministrador', '!=', $datos['id'])->get();
        if (count($validacionCorreo) > 0 || count($validacionCorreoUser) > 0) {
            $aErrores[] = '- El correo ya se encuentra registrado';
        }
        if (count($aErrores) > 0) {
            throw new \Exception(join('</br>', $aErrores));
        }
        try {
            $actualizarAdministrador = Administradores::with('usuario')->findOrFail($datos['id']);;
            $actualizarAdministrador->administrador = $datos['administrador'];
            $actualizarAdministrador->codigo_administrador = $datos['codigoadministrador'];
            $actualizarAdministrador->n_celular = $datos['celular'];
            if($actualizarAdministrador->email != $datos['email'] || $actualizarAdministrador->codigo_administrador != $datos['codigoadministrador']){
                $actualizarAdministrador->usuario->documento = $datos['codigoadministrador'];
                $actualizarAdministrador->usuario->email = $datos['email'];
                $actualizarAdministrador->usuario->save();
            }
            $actualizarAdministrador->email = $datos['email'];
            $actualizarAdministrador->save();
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
    public function eliminarAdministradores($datos)
    {
        $aErrores = array();
        DB::beginTransaction();
        if ($datos['id'] == "") {
            $aErrores[] = '- No existe administrador a eliminar';
        }
        if (count($aErrores) > 0) {
            throw new \Exception(join('</br>', $aErrores));
        }
        try {
            $eliminarAdministrador = Administradores::findOrFail($datos['id']);
            $eliminarAdministrador->delete();
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
