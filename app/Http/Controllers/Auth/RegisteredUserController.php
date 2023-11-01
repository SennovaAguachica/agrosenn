<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;
use App\Models\Tipodocumentos;
use App\Models\Departamentos;
use App\Models\Ciudades;
use App\Models\Vendedores;
use App\Models\Asociaciones;
use App\Models\Clientes;
use App\Models\Categorias;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Validator;
class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        $tiposDocumentos = Tipodocumentos::all();
        $departamentos = Departamentos::all();
        $categorias = Categorias::all();
        return view('vistas.login.register',compact('tiposDocumentos','departamentos','categorias'));
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        // dd($request->all());
        $aErrores = array();
        DB::beginTransaction();
        if (
            $request->idtipodocumento == ""
            ||  $request->documento == "" 
            || $request->nombres == "" 
            ||  $request->apellidos == "" 
            ||  $request->celular == "" 
            || $request->idmunicipio == ""
            ||  $request->password == ""
            ||  $request->password_confirmation == ""
            ||  $request->tiporegistro == ""
        ) 
        {
            $aErrores[] = '- Faltan datos obligatorios para el registro';
        }
        if($request->tiporegistro == 3){
            if ($request->codigoasociacion == ""){
                $aErrores[] = '- Falta el codigo de asociación';
            }
            $validacionVendedor = Vendedores::where([
                ['n_documento', $request->documento]
            ])->get();
            if (count($validacionVendedor) > 0) {
                $aErrores[] = '- Este nº de documento ya se encuentra registrado';
            }
            $validacionEmail = Vendedores::where([
                ['email', $request->email]
            ])->get();
            if (count($validacionEmail) > 0) {
                $aErrores[] = '- Este correo electronico ya se encuentra registrado';
            }
            $validacionAsociacion = Asociaciones::where([
                ['codigo_asociacion', $request->codigoasociacion]
            ])->first();
            if(!$validacionAsociacion){
                $aErrores[] = '- No existe una asociación con el codigo ingresado';
            }
        }else if($request->tiporegistro == 4){
            $validacionCliente = Clientes::where([
                ['n_documento', $request->documento]
            ])->get();
            if (count($validacionCliente) > 0) {
                $aErrores[] = '- Este nº de documento ya se encuentra registrado';
            }
            $validacionEmail = Clientes::where([
                ['email', $request->email]
            ])->get();
            if (count($validacionEmail) > 0) {
                $aErrores[] = '- Este correo electronico ya se encuentra registrado';
            }
        }
        if (count($aErrores) > 0) {
            throw new \Exception(join('</br>', $aErrores));
        }
        try {
            $vPassword = $request->validate([
                'password' => ['required', 'confirmed', Rules\Password::defaults()],
            ]);
            if (!empty($vPassword)) {
                $aErrores[] = $vPassword;
            }
            if($request->tiporegistro == 3){
                $nuevoVendedor = new Vendedores();
                $nuevoVendedor->id_tipodocumento = $request->idtipodocumento;
                $nuevoVendedor->id_asociacion = $validacionAsociacion->id;
                $nuevoVendedor->id_municipio = $request->idmunicipio;
                $nuevoVendedor->n_documento = $request->documento;
                $nuevoVendedor->nombres = $request->nombres;
                $nuevoVendedor->apellidos = $request->apellidos;
                $nuevoVendedor->direccion = $request->direccion;
                $nuevoVendedor->n_celular = $request->celular;
                $nuevoVendedor->email = $request->email;
                $nuevoVendedor->estado = 0;
                $nuevoVendedor->created_at = \Carbon\Carbon::now();
                $nuevoVendedor->updated_at = \Carbon\Carbon::now();
                $nuevoVendedor->save();
                $ultimoInsertado = Vendedores::latest('id')->first();
            
                $nuevoUsuario = new User();
                $nuevoUsuario->idrol = 3;
                $nuevoUsuario->idvendedor = $ultimoInsertado->id;
                $nuevoUsuario->email = $request->email;
                $nuevoUsuario->password = Hash::make($request->password);
                $nuevoUsuario->estado = 0;
                $nuevoUsuario->save();
                $nuevoUsuario->roles()->sync(3);
            }else if($request->tiporegistro == 4){
                $nuevoCliente = new Clientes();
                $nuevoCliente->id_tipodocumento = $request->idtipodocumento;
                $nuevoCliente->id_municipio = $request->idmunicipio;
                $nuevoCliente->n_documento = $request->documento;
                $nuevoCliente->nombres = $request->nombres;
                $nuevoCliente->apellidos = $request->apellidos;
                $nuevoCliente->direccion = $request->direccion;
                $nuevoCliente->n_celular = $request->celular;
                $nuevoCliente->email = $request->email;
                $nuevoCliente->estado = 1;
                $nuevoCliente->created_at = \Carbon\Carbon::now();
                $nuevoCliente->updated_at = \Carbon\Carbon::now();
                $nuevoCliente->save();
                $ultimoInsertado = Clientes::latest('id')->first();
            
                $nuevoCliente = new User();
                $nuevoCliente->idrol = 4;
                $nuevoCliente->idcliente = $ultimoInsertado->id;
                $nuevoCliente->email = $request->email;
                $nuevoCliente->password = Hash::make($request->password);
                $nuevoCliente->estado = 1;
                $nuevoCliente->save();
                $nuevoCliente->roles()->sync(4);
                Auth::login($nuevoCliente);
            }
            DB::commit();
            // return redirect(RouteServiceProvider::HOME);
            $respuesta = array(
                'mensaje'      => "",
                'estado'      => 1,
            );
            return response()->json($respuesta);
        } catch (\Exception $e) {
            DB::rollback();
            // $aErrores = array_merge($aErrores, $e->errors());
            throw  $e;
        }
    }
    public function buscarMunicipiosRegister(Request $request)
    {
        $municipios = Ciudades::where('iddepartamentos', $request->iddepartamento)->get();
        return $municipios;
    }
}
