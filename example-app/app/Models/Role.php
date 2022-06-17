<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model{
    use HasFactory;

    /********************
        ASOCIACIONES
    *********************/

    //Usuarios 1:N
    public function users(){
        return $this->hasMany(User::class);
    }

    //Privilegios N:N
    public function privileges(){
        return $this->belongsToMany(Privilege::class, "privileges_roles");
    }

}
