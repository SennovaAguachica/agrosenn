<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Traits\HasRoles;


class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $table = "users";
    protected $fillable = [
        'idrol',
        'idvendedor',
        'idasociacion',
        'idcliente',
        'idadministrador',
        'estado',
        'documento',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];
    public function rol()
    {
        return $this->belongsTo(Role::class,'idrol','id');
    }
    public function vendedor()
    {
        return $this->belongsTo(Vendedores::class,'idvendedor','id');
    }
    public function asociacion()
    {
        return $this->belongsTo(Asociaciones::class,'idasociacion','id');
    }
    public function cliente()
    {
        return $this->belongsTo(Clientes::class,'idcliente','id');
    }
    public function administrador()
    {
        return $this->belongsTo(Administradores::class,'idadministrador','id');
    }
}
