<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role_id'
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
    ];

    /********************
        ASOCIACIONES
    *********************/

    //Roles N:1
    public function role(){
        return $this->belongsTo(Role::class);
    }

    /********************************
        FUNCIONES DE LA INSTANCIA
    ********************************/

    //Devuelve el nombre del rol asociado al usuario
    public function getRoleName(){
        return $this->role->name;
    }

    //Indica si el usuario es administrador
    public function isAdmin(){
        return ( strtolower($this->getRoleName()) === strtolower("admin") );
    }

    //Verifica si el usuario tiene el rol pasado como parámetro
    public function hasRole($role){
        return ( strtolower($this->getRoleName()) === strtolower($role) );
    }

    //Verifica si el usuario tiene el privilegio pasado como parámetro
    public function hasPrivilege($privilege){
        
        $privileges = $this->role->privileges;

        foreach($privileges as $priv){

            if( strtolower($priv->name) === strtolower($privilege) ){
                return true;
            }

        }

        return false;

    }

}
