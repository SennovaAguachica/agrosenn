<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Departamentos;
use App\Models\Ciudades;
use App\Models\Tipodocumentos;
use App\Models\Administradores;
use App\Models\Asociaciones;
use App\Models\Vendedores;
use App\Models\Clientes;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;

class PerfilController extends Controller
{
    public function index(Request $request)
    {
        $departamentos = Departamentos::all();
        $tiposDocumentos = Tipodocumentos::all();
        $perfil = auth()->user();
        $user = auth()->user();
        switch ($user->idrol) {
            case 1:
                $user->load('administrador');
                break;
            case 2:
                $user->load('asociacion.municipio.departamento.ciudades');
                break;
            case 3:
                $user->load('vendedor.municipio.departamento.ciudades');
                break;
            case 4:
                $user->load('cliente');
                break;
        }
        return view('vistas.backend.perfil.perfil',compact('departamentos','tiposDocumentos','user','perfil'));
    }
    public function peticionesAction(Request $request)
    {
        $BUSCAR_MUNICIPIOS = 1;
        $ACTUALIZAR_PERFIL = 2;
        $ACTUALIZAR_CONTRASENA = 3;
        try {
            switch ($request->accion) {
                case $BUSCAR_MUNICIPIOS:
                    $municipios = $this->buscarMunicipios($request->all());
                    return $municipios;
                    break;
                case $ACTUALIZAR_PERFIL:
                    $respuesta = $this->actualizarPerfil($request->all());
                    return $respuesta;
                    break;
                case $ACTUALIZAR_CONTRASENA:
                    $respuesta = $this->actualizarPassword($request->all());
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
    public function buscarMunicipios($datos)
    {
        $municipios = Ciudades::where('iddepartamentos', $datos['iddepartamento'])->get();
        return $municipios;
    }
    public function actualizarPerfil($datos)
    {
        $aErrores = array();
        DB::beginTransaction();
        try {
            switch ($datos['idrol']) {
                case 1:
                    $administrador = Administradores::with('usuario')->findOrFail($datos['id']);
                    $administrador->administrador = $datos['administrador'];
                    $administrador->codigo_administrador = $datos['codadministrador'];
                    $administrador->n_celular = $datos['telefonoadmin'];
                    $administrador->direccion = $datos['direccionadmin'];
                    $administrador->email = $datos['emailadmin'];
                    $administrador->usuario->documento = $datos['codadministrador'];
                    $administrador->usuario->email = $datos['emailadmin'];
                    if (!empty($datos['fotoinput'])) {
                        if ($datos['fotoinput'] != null) {
                            //existe un archivo cargado?
                            $rutaImagenAnterior = '/fotosperfil/' . basename($administrador->usuario->fotoperfil);
                            if (Storage::disk('public')->exists($rutaImagenAnterior)) {
                                Storage::disk('public')->delete($rutaImagenAnterior);
                            }
                            //guardo el archivo nuevo
                            $imagen = Storage::disk('public')->put('/fotosperfil', $datos['fotoinput']);
                            $urlImagen = Storage::url($imagen);
                        }else{
                            $imagen = Storage::disk('public')->put('/fotosperfil', $datos['fotoinput']);
                            $urlImagen = Storage::url($imagen);
                        }

                        $administrador->usuario->fotoperfil = $urlImagen;
                    }
                    $administrador->usuario->save();
                    $administrador->save();
                    break;
                case 2:
                    $asociacion = Asociaciones::with('usuario')->findOrFail($datos['id']);
                    $asociacion->codigo_asociacion = $datos['codasociacion'];
                    $asociacion->asociacion = $datos['asociacion'];
                    $asociacion->n_celular = $datos['telefonoasociacion'];
                    $asociacion->direccion = $datos['direcionasociacion'];
                    $asociacion->email = $datos['emailasociacion'];
                    $asociacion->id_municipio = $datos['idmunicipioasociacion'];
                    $asociacion->usuario->documento = $datos['codasociacion'];
                    $asociacion->usuario->email = $datos['emailasociacion'];
                    if (!empty($datos['fotoinput'])) {
                        if ($datos['fotoinput'] != null) {
                            //existe un archivo cargado?
                            $rutaImagenAnterior = '/fotosperfil/' . basename($asociacion->usuario->fotoperfil);
                            if (Storage::disk('public')->exists($rutaImagenAnterior)) {
                                Storage::disk('public')->delete($rutaImagenAnterior);
                            }
                            //guardo el archivo nuevo
                            $imagen = Storage::disk('public')->put('/fotosperfil', $datos['fotoinput']);
                            $urlImagen = Storage::url($imagen);
                        }else{
                            $imagen = Storage::disk('public')->put('/fotosperfil', $datos['fotoinput']);
                            $urlImagen = Storage::url($imagen);
                        }
                        $asociacion->usuario->fotoperfil = $urlImagen;
                    }
                    $asociacion->usuario->save();
                    $asociacion->save();
                    break;
                case 3:
                    $vendedor = Vendedores::with('usuario')->findOrFail($datos['id']);
                    $vendedor->id_tipodocumento = $datos['idtipodocumento'];
                    $vendedor->id_municipio = $datos['idmunicipiovendedor'];
                    $vendedor->n_documento = $datos['documentovendedor'];
                    $vendedor->nombres = $datos['nombrevendedor'];
                    $vendedor->apellidos = $datos['apellidovendedor'];
                    $vendedor->direccion = $datos['direccionvendedor'];
                    $vendedor->n_celular = $datos['telefonovendedor'];
                    $vendedor->email = $datos['emailvendedor'];
                    $vendedor->usuario->documento = $datos['documentovendedor'];
                    $vendedor->usuario->email = $datos['emailvendedor'];
                    if (!empty($datos['fotoinput'])) {
                        if ($datos['fotoinput'] != null) {
                            //existe un archivo cargado?
                            $rutaImagenAnterior = '/fotosperfil/' . basename($vendedor->usuario->fotoperfil);
                            if (Storage::disk('public')->exists($rutaImagenAnterior)) {
                                Storage::disk('public')->delete($rutaImagenAnterior);
                            }
                            //guardo el archivo nuevo
                            $imagen = Storage::disk('public')->put('/fotosperfil', $datos['fotoinput']);
                            $urlImagen = Storage::url($imagen);
                        }else{
                            $imagen = Storage::disk('public')->put('/fotosperfil', $datos['fotoinput']);
                            $urlImagen = Storage::url($imagen);
                        }
                        $vendedor->usuario->fotoperfil = $urlImagen;
                    }
                    $vendedor->usuario->save();
                    $vendedor->save();
                    break;
                case 4:
                    $usuario = Clientes::with('usuario')->findOrFail($datos['id']);
                    break;
            }
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
    public function actualizarPassword($datos)
    {
        $aErrores = array();
        $vUsuario = User::findOrFail($datos['iduserpassword']);
        if (!Hash::check($datos['passwordactual'], $vUsuario->password)) {
            $aErrores[] = '- La contraseña actual digitada no coincide con la registrada en el sistema';
        }
        if ($datos['passwordnuevo'] != $datos['passwordconfirmar']) {
            $aErrores[] = '- La contraseña nueva y la confirmación no coinciden.';
        }
        if (count($aErrores) > 0) {
            throw new \Exception(join('</br>', $aErrores));
        }
        DB::beginTransaction();
        try {
            $vUsuario->password = Hash::make($datos['passwordnuevo']);
            $vUsuario->save();
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
}
