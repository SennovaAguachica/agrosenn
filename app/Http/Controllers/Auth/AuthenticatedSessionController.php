<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use App\Models\Categorias;
use App\Models\Asociaciones;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        $categorias = Categorias::all();
        $asociaciones = Asociaciones::all();
        return view('vistas.login.login',compact('categorias','asociaciones'));
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();

        $request->session()->regenerate();

        // return redirect()->intended(RouteServiceProvider::HOME);
        
        $rol = auth()->user();
        if($rol->idrol == 1){
            return redirect()->intended(RouteServiceProvider::ADMINISTRADORHOME);
        }else if($rol->idrol == 2){
            return redirect()->intended(RouteServiceProvider::ASOCIACIONHOME);
        }else if($rol->idrol == 3){
            return redirect()->intended(RouteServiceProvider::VENDEDORHOME);
        }else if($rol->idrol == 4){
            return redirect()->intended(RouteServiceProvider::CLIENTEHOME);
        }else{
            return redirect()->intended(RouteServiceProvider::VENDEDORHOME);
        }
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
