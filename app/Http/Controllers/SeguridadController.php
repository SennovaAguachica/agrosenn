<?php

namespace App\Http\Controllers;

use App\Models\Roles;
use App\Models\User;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Auth;
use HasRoles;
class SeguridadController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
        //Validacion permisos usuarios
        $this->middleware('can:usuarios.listar')->only('indexusuarios');
        $this->middleware('can:usuarios.actualizar')->only('actualizarUsuarios');
        $this->middleware('can:usuarios.eliminar')->only('eliminarUsuarios');
        $this->middleware('can:usuarios.habilitar')->only('habilitarUsuarios');
        //Validacion permisos permisos
        $this->middleware('can:permisos.listar')->only('indexpermisos');
        $this->middleware('can:permisos.guardar')->only('guardarPermisos');
        $this->middleware('can:permisos.actualizar')->only('actualizarPermisos');
        $this->middleware('can:permisos.eliminar')->only('eliminarPermisos');
        //Validacion permisos roles
        $this->middleware('can:roles.listar')->only('indexroles');
        $this->middleware('can:roles.actualizar')->only('actualizarRol');
    }
    public function indexusuarios(Request $request)
    {
        // dd(Auth::user()->can('usuarios.listar'));
        $roles = Role::all();
        if ($request->ajax()) {
            return DataTables::of(User::with('rol','vendedor','asociacion','cliente','administrador')->where('id', '!=', auth()->id())->get())->addIndexColumn()
            ->addColumn('action', function($data){
                $btn = "";
                if($data->estado == 1 && Auth::user()->can('usuarios.actualizar')){
                    $btn = '<button type="button" title="Editar usuario" class="editbutton btn btn-success" style="color:white" onclick="buscarId('.$data->id.',1)" data-bs-toggle="modal"
                    data-bs-target="#modalGuardarForm"><i class="fa-solid fa-pencil"></i></button>';
                }
                if($data->estado == 1 && Auth::user()->can('usuarios.eliminar')){
                    $btn .= "&nbsp";
                    $btn .= '<button type="button" title="Eliminar usuario" class="deletebutton btn btn-danger" onclick="buscarId('.$data->id.',2)"><i class="fas fa-trash"></i></button>';
                }
                if($data->estado == 0 && Auth::user()->can('usuarios.habilitar')){
                    $btn = '<button type="button" title="Habilitar usuario" class="habilitarbutton btn btn-primary" style="color:white" onclick="buscarId('.$data->id.',3)"><i class="fas fa-angle-double-up"></i> Habilitar</button>';
                }
                return $btn;
            })
            ->rawColumns(['action'])
            ->make(true);
        }
        return view ('vistas.backend.seguridad.usuarios',compact('roles'));
    }
    public function indexroles(Request $request)
    {
        $usuario = auth()->user();

        // Obtener los roles del usuario
        $roles = $usuario->getPermissionNames();
        // dd($roles);
        $permisos = Permission::get()->groupBy('grupo');
        if ($request->ajax()) {
            return DataTables::of(Role::with('permissions')->get())->addIndexColumn()
            ->addColumn('action', function($data){
                $btn = "";
                if(Auth::user()->can('roles.actualizar')){
                    $btn = '<button type="button" title="Editar rol" class="editbutton btn btn-success" style="color:white" onclick="buscarId('.$data->id.',1)" data-bs-toggle="modal"
                    data-bs-target="#modalGuardarForm"><i class="fa-solid fa-pencil"></i> Editar permisos</button>';
                }
                return $btn;
            })
            ->rawColumns(['action'])
            ->make(true);
        }
        return view ('vistas.backend.seguridad.roles',compact('permisos'));
    }
    public function indexpermisos(Request $request)
    {
        if ($request->ajax()) {
            return DataTables::of(Permission::all())->addIndexColumn()
            ->addColumn('action', function($data){
                $btn = "";
                if(Auth::user()->can('permisos.actualizar')){
                    $btn = '<button type="button" title="Editar permiso" class="editbutton btn btn-success" style="color:white" onclick="buscarId('.$data->id.',1)" data-bs-toggle="modal"
                    data-bs-target="#modalGuardarForm"><i class="fa-solid fa-pencil"></i></button>';
                }
                if(Auth::user()->can('permisos.eliminar')){
                    $btn .= "&nbsp";
                    $btn .= '<button type="button" title="Eliminar permiso" class="deletebutton btn btn-danger" onclick="buscarId('.$data->id.',2)"><i class="fas fa-trash"></i></button>';
                }
                return $btn;
            })
            ->rawColumns(['action'])
            ->make(true);
        }
        return view ('vistas.backend.seguridad.permisos');
    }
    public function peticionesAction(Request $request)
    {
        $ACTUALIZAR_USUARIOS = 1;
        $ELIMINAR_USUARIOS = 2;
        $HABILITAR_USUARIOS = 3;
        $GUARDAR_PERMISOS = 4;
        $ACTUALIZAR_PERMISOS = 5;
        $ELIMINAR_PERMISOS = 6;
        $ACTUALIZAR_ROL = 7;
        try {
            switch ($request->accion) {
                case $ACTUALIZAR_USUARIOS:
                    $respuesta = $this->actualizarUsuarios($request->all());
                    return $respuesta;
                    break;
                case $ELIMINAR_USUARIOS:
                    $respuesta = $this->eliminarUsuarios($request->all());
                    return $respuesta;
                    break;
                case $HABILITAR_USUARIOS:
                    $respuesta = $this->habilitarUsuarios($request->all());
                    return $respuesta;
                    break;
                case $GUARDAR_PERMISOS:
                    $respuesta = $this->guardarPermisos($request->all());
                    return $respuesta;
                    break;
                case $ACTUALIZAR_PERMISOS:
                    $respuesta = $this->actualizarPermisos($request->all());
                    return $respuesta;
                    break;
                case $ELIMINAR_PERMISOS:
                    $respuesta = $this->eliminarPermisos($request->all());
                    return $respuesta;
                    break;
                case $ACTUALIZAR_ROL:
                    $respuesta = $this->actualizarRol($request->all());
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
    public function actualizarUsuarios($datos)
    {
        $aErrores = array();
        DB::beginTransaction();
        if ($datos['id'] == "" || $datos['email'] == "" || $datos['id'] == "undefined") {
            $aErrores[] = '- Faltan datos obligatorios';
        }
        if (count($aErrores) > 0) {
            throw new \Exception(join('</br>', $aErrores));
        }
        try {
            $usuario = User::findOrFail($datos['id']);
            $usuario->email = $datos['email'];
            if($datos['password']!=null){
                $usuario->password = Hash::make($datos['password']);
            }
            $usuario->save();
            DB::commit();
            $respuesta = array(
                'mensaje'      => "",
                'estado'      => 1,
            );
            return response()->json($respuesta);
        } 
        catch (\Exception $e) 
        {
            DB::rollback();
            throw $e;
            // something went wrong
        }
    }
    public function eliminarUsuarios($datos)
    {
        $aErrores = array();
        DB::beginTransaction();
        if ($datos['id'] == "" || $datos['id'] == "undefined") {
            $aErrores[] = '- No existe usuario a eliminar';
        }
        if (count($aErrores) > 0) {
            throw new \Exception(join('</br>', $aErrores));
        }
        try {
            $eliminarUsuario = User::findOrFail($datos['id']);
            $eliminarUsuario->update(['estado' => '0']);
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
    public function habilitarUsuarios($datos)
    {
        $aErrores = array();
        DB::beginTransaction();
        if ($datos['id'] == "") {
            $aErrores[] = '- No existe usuario a habilitar';
        }
        if (count($aErrores) > 0) {
            throw new \Exception(join('</br>', $aErrores));
        }
        try {
            $habilitarUsuario = User::findOrFail($datos['id']);
            $habilitarUsuario->update(['estado' => '1']);
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
    public function guardarPermisos($datos)
    {
        $aErrores = array();
        DB::beginTransaction();
        if ($datos['permiso'] == "" || $datos['grupo'] == "") {
            $aErrores[] = '- Faltan datos obligatorios';
        }
        if (count($aErrores) > 0) {
            throw new \Exception(join('</br>', $aErrores));
        }
        try {
            $nuevoPermiso = new Permission();
            $nuevoPermiso->name = $datos['permiso'];
            $nuevoPermiso->description = $datos['descripcion'];
            $nuevoPermiso->grupo = $datos['grupo'];
            $nuevoPermiso->created_at = \Carbon\Carbon::now();
            $nuevoPermiso->updated_at = \Carbon\Carbon::now();
            $nuevoPermiso->save();
            DB::commit();
            $respuesta = array(
                'mensaje'      => "",
                'estado'      => 1,
            );
            return response()->json($respuesta);
        } 
        catch (\Exception $e) 
        {
            DB::rollback();
            throw $e;
            // something went wrong
        }
    }
    public function actualizarPermisos($datos)
    {
        $aErrores = array();
        DB::beginTransaction();
        if ($datos['id'] == "" || $datos['id'] == "undefined") {
            $aErrores[] = '- No existe permiso a actualizar';
        }
        if (count($aErrores) > 0) {
            throw new \Exception(join('</br>', $aErrores));
        }
        try {
            $actualizarPermisos = Permission::findOrFail($datos['id']);
            $actualizarPermisos->name = $datos['permiso'];
            $actualizarPermisos->description = $datos['descripcion'];
            $actualizarPermisos->grupo = $datos['grupo'];
            $actualizarPermisos->save();
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
    public function eliminarPermisos($datos)
    {
        $aErrores = array();
        DB::beginTransaction();
        if ($datos['id'] == "" || $datos['id'] == "undefined") {
            $aErrores[] = '- No existe permiso a eliminar';
        }
        if (count($aErrores) > 0) {
            throw new \Exception(join('</br>', $aErrores));
        }
        try {
            $eliminarPermisos = Permission::findOrFail($datos['id']);
            $eliminarPermisos->delete();
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
    public function actualizarRol($datos)
    {
        $aErrores = array();
        DB::beginTransaction();
        if ($datos['id'] == "" || $datos['id'] == "undefined" ) {
            $aErrores[] = '- No existe permiso a actualizar';
        }
        if(!array_key_exists('permisos', $datos)){
            $aErrores[] = '- No existe permisos a asociar';
        }
        if (count($aErrores) > 0) {
            throw new \Exception(join('</br>', $aErrores));
        }
        try {
            $actualizarRol = Role::with('permissions')->findOrFail($datos['id']);
            $actualizarRol->syncPermissions($datos['permisos']);
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
