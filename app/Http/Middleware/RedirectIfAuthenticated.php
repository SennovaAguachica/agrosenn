<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, string ...$guards): Response
    {
        $guards = empty($guards) ? [null] : $guards;

        foreach ($guards as $guard) {
            if (Auth::guard($guard)->check()) {
                $rol = auth()->user();
                if($rol->idrol == 1){
                    return redirect(RouteServiceProvider::ADMINISTRADORHOME);
                }else if($rol->idrol == 2){
                    return redirect(RouteServiceProvider::ASOCIACIONHOME);
                }else if($rol->idrol == 3){
                    return redirect(RouteServiceProvider::VENDEDORHOME);
                }else if($rol->idrol == 4){
                    return redirect(RouteServiceProvider::CLIENTEHOME);
                }
            }
        }

        return $next($request);
    }
}
