<?php

namespace App\Http\Requests\Auth;

use Illuminate\Auth\Events\Lockout;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;
use App\Models\User;
use App\Models\Administradores;
use App\Models\Clientes;
use App\Models\Vendedores;
use App\Models\Asociaciones;

class LoginRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'usuario' => ['required', 'string'],
            'password' => ['required', 'string'],
        ];
    }

    /**
     * Attempt to authenticate the request's credentials.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function authenticate(): void
    {
        // $this->ensureIsNotRateLimited();
        // $user = User::where('email',$this->only('email'))->first();
        // if($user){
        //     if($user->estado==0){
        //         throw ValidationException::withMessages([
        //             'name' => 'Este usuario se encuentra desactivado',
        //         ]);  
        //     }
        // }
        // if (! Auth::attempt($this->only('email', 'password'), $this->boolean('remember'))) {
        //     RateLimiter::hit($this->throttleKey());

        //     throw ValidationException::withMessages([
        //         'email' => trans('auth.failed'),
        //     ]);
        // }

        // RateLimiter::clear($this->throttleKey());

        $this->ensureIsNotRateLimited();

        $credentials = $this->only(['usuario', 'password']); // Obtener las credenciales del usuario
        // Asegúrate de que la clave 'usuario' sea reemplazada por 'email' o 'documento' según corresponda
        if (filter_var($credentials['usuario'], FILTER_VALIDATE_EMAIL)) {
            $credentials['email'] = $credentials['usuario'];
            unset($credentials['usuario']);
        } else {
            $credentials['documento'] = $credentials['usuario'];
            unset($credentials['usuario']);
        }
        
        $user = User::where(function ($query) use ($credentials) {
            if (isset($credentials['email'])) {
                $query->where('email', $credentials['email']);
            }
            if (isset($credentials['documento'])) {
                $query->orWhere('documento', $credentials['documento']);
            }
        })->first();
        if (!$user) {
            throw ValidationException::withMessages([
                'name' => trans('auth.failed'),
            ]);
        }

        if ($user->estado == 0) {
            throw ValidationException::withMessages([
                'name' => 'Este usuario se encuentra desactivado',
            ]);
        }

        if (!Auth::attempt($credentials, $this->boolean('remember'))) {
            RateLimiter::hit($this->throttleKey());

            throw ValidationException::withMessages([
                'usuario' => trans('auth.failed'),
            ]);
        }

        RateLimiter::clear($this->throttleKey());

    }

    /**
     * Ensure the login request is not rate limited.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function ensureIsNotRateLimited(): void
    {

        if (! RateLimiter::tooManyAttempts($this->throttleKey(), 5)) {
            return;
        }

        event(new Lockout($this));

        $seconds = RateLimiter::availableIn($this->throttleKey());
        throw ValidationException::withMessages([
            'email' => trans('auth.throttle', [
                'seconds' => $seconds,
                'minutes' => ceil($seconds / 60),
            ]),
        ]);
    }

    /**
     * Get the rate limiting throttle key for the request.
     */
    public function throttleKey(): string
    {
        return Str::transliterate(Str::lower($this->input('email')).'|'.$this->ip());
    }
}
