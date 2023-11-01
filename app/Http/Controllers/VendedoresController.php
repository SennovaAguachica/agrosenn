<?php

namespace App\Http\Controllers;

use App\Models\Vendedores;
use App\Models\Tipodocumentos;
use App\Models\Departamentos;
use App\Models\Ciudades;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Auth;

class VendedoresController extends Controller
{
    public function index(Request $request)
    {
        $tiposDocumentos = Tipodocumentos::all();
        $departamentos = Departamentos::all();
        if ($request->ajax()) {
            return DataTables::of(Vendedores::with('tipodocumento','municipio.departamento')->where('id_asociacion', Auth::user()->idasociacion)->get())->addIndexColumn()
                ->addColumn('action', function ($data) {
                    $btn = "";
                    if($data->estado == 1 && Auth::user()->can('vendedores.actualizar')){
                            $btn = '<button type="button"  class="editbutton btn btn-success" style="color:white" onclick="buscarId(' . $data->id . ',1)" data-bs-toggle="modal"
                        data-bs-target="#modalGuardarForm"><i class="fa-solid fa-pencil"></i></button>';
                    }
                    if($data->estado == 1 && Auth::user()->can('vendedores.eliminar')){
                        $btn .= "&nbsp";
                        $btn .= '<button type="button"  class="deletebutton btn btn-danger" onclick="buscarId(' . $data->id . ',2)"><i class="fas fa-trash"></i></button>';
                    }
                    if($data->estado == 0 && Auth::user()->can('vendedores.habilitar')){
                        $btn .= "&nbsp";
                        $btn .= '<button type="button"  class="habilitarbutton btn btn-primary" onclick="buscarId(' . $data->id . ',3)"><i class="fas fa-angle-double-up"></i> Habilitar</button>';
                    }
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('vistas.backend.vendedores.vendedores',compact('tiposDocumentos','departamentos'));
    }
    public function peticionesAction(Request $request)
    {
        $GUARDAR_VENDEDORES = 1;
        $ACTUALIZAR_VENDEDORES = 2;
        $ELIMINAR_VENDEDORES = 3;
        $BUSCAR_MUNICIPIOS = 4;
        $HABILITAR_VENDEDORES = 5;
        try {
            // buscar 001
            // crear 002
            // editar 003
            // eliminar 004
            switch ($request->accion) {
                case $GUARDAR_VENDEDORES:
                    $respuesta = $this->guardarVendedores($request->all());
                    return $respuesta;
                    break;
                case $ACTUALIZAR_VENDEDORES:
                    $respuesta = $this->actualizarVendedores($request->all());
                    return $respuesta;
                    break;
                case $ELIMINAR_VENDEDORES:
                    $respuesta = $this->eliminarVendedores($request->all());
                    return $respuesta;
                    break;
                case $BUSCAR_MUNICIPIOS:
                    $municipios = $this->buscarMunicipios($request->all());
                    return $municipios;
                    break;
                case $HABILITAR_VENDEDORES:
                    $respuesta = $this->habilitarVendedor($request->all());
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
    public function guardarVendedores($datos)
    {
        $aErrores = array();
        DB::beginTransaction();
        if ($datos['idtipodocumento'] == "" && $datos['documento'] == "" && $datos['nombres'] == "" && $datos['apellidos'] == "" && $datos['celular'] == "" && $datos['idmunicipio'] == "") {
            $aErrores[] = '- Faltan datos necesarios';
        }
        $validacionDocumento = Vendedores::where([
            ['n_documento', $datos['documento']]
        ])->get();
        if (count($validacionDocumento) > 0) {
            $aErrores[] = '- El vendedor ya se encuentra registrado';
        }
        if($datos['email']){
            $validacionCorreo = Vendedores::where([
                ['email', $datos['email']]
            ])->get();
            $validacionCorreoUser = User::where([
                ['email', $datos['email']]
            ])->get();
            if (count($validacionCorreo) > 0 || count($validacionCorreoUser) > 0) {
                $aErrores[] = '- Este correo electronico ya se encuentra registrado';
            }
        }
        if (count($aErrores) > 0) {
            throw new \Exception(join('</br>', $aErrores));
        }
        try {
            $nuevoVendedor = new Vendedores();
            $nuevoVendedor->id_tipodocumento = $datos['idtipodocumento'];
            $nuevoVendedor->id_municipio = $datos['idmunicipio'];
            $nuevoVendedor->id_asociacion = Auth::user()->id;
            $nuevoVendedor->n_documento = $datos['documento'];
            $nuevoVendedor->nombres = $datos['nombres'];
            $nuevoVendedor->apellidos = $datos['apellidos'];
            $nuevoVendedor->direccion = $datos['direccion'];
            $nuevoVendedor->n_celular = $datos['celular'];
            $nuevoVendedor->email = $datos['email'];
            $nuevoVendedor->estado = 1;
            $nuevoVendedor->created_at = \Carbon\Carbon::now();
            $nuevoVendedor->updated_at = \Carbon\Carbon::now();
            $nuevoVendedor->save();
            //Obtener el id vendedor del ultimo registro
            $ultimoInsertado = Vendedores::latest('id')->first();
            
            $nuevoUsuario = new User();
            $nuevoUsuario->idrol = 3;
            $nuevoUsuario->idvendedor = $ultimoInsertado->id;
            $nuevoUsuario->email = $datos['email'];
            $nuevoUsuario->password = Hash::make($datos['documento']);
            $nuevoUsuario->estado = 1;
            $nuevoUsuario->save();
            $nuevoUsuario->roles()->sync(3);
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
    public function actualizarVendedores($datos)
    {
        $aErrores = array();
        DB::beginTransaction();
        if ($datos['idtipodocumento'] == "" && $datos['documento'] == "" && $datos['nombres'] == "" && $datos['apellidos'] == "" && $datos['celular'] == "" && $datos['idmunicipio'] == "") {
            $aErrores[] = '- Faltan datos necesarios';
        }
        $validacionDocumento = Vendedores::where([
            ['n_documento', $datos['documento']]
        ])->where('id', '!=', $datos['id'])->get();
        if (count($validacionDocumento) > 0) {
            $aErrores[] = '- El vendedor ya se encuentra registrado';
        }
        if($datos['email']){
            $validacionCorreo = Vendedores::where([
                ['email', $datos['email']]
            ])->where('id', '!=', $datos['id'])->get();

            $validacionCorreoUser = User::where([
                ['email', $datos['email']]
            ])->where('idvendedor', '!=', $datos['id'])->get();

            if (count($validacionCorreo) > 0 || count($validacionCorreoUser) > 0) {
                $aErrores[] = '- Este correo electronico ya se encuentra registrado';
            }
        }
        if (count($aErrores) > 0) {
            throw new \Exception(join('</br>', $aErrores));
        }
        try {
            $actualizarVendedor = Vendedores::with('usuario')->findOrFail($datos['id']);;
            $actualizarVendedor->id_tipodocumento = $datos['idtipodocumento'];
            $actualizarVendedor->id_municipio = $datos['idmunicipio'];
            $actualizarVendedor->n_documento = $datos['documento'];
            $actualizarVendedor->nombres = $datos['nombres'];
            $actualizarVendedor->apellidos = $datos['apellidos'];
            $actualizarVendedor->direccion = $datos['direccion'];
            $actualizarVendedor->n_celular = $datos['celular'];
            if($actualizarVendedor->email != $datos['email']){
                $actualizarVendedor->usuario->email = $datos['email'];
                $actualizarVendedor->usuario->save();
            }
            $actualizarVendedor->email = $datos['email'];
            $actualizarVendedor->save();
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
    public function eliminarVendedores($datos)
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
            $eliminarVendedor = Vendedores::with('usuario')->findOrFail($datos['id']);
            $eliminarVendedor->update(['estado' => '0']);
            if($eliminarVendedor->usuario){
                $eliminarVendedor->usuario->update(['estado' => '0']);
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
    public function habilitarVendedor($datos)
    {
        $aErrores = array();
        DB::beginTransaction();
        if ($datos['id'] == "") {
            $aErrores[] = '- No existe vendedor a habilitar';
        }
        if (count($aErrores) > 0) {
            throw new \Exception(join('</br>', $aErrores));
        }
        try {
            $habilitarVendedor = Vendedores::with('usuario')->findOrFail($datos['id']);
            $habilitarVendedor->update(['estado' => '1']);
            if($habilitarVendedor->usuario){
                $habilitarVendedor->usuario->update(['estado' => '1']);
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
}
