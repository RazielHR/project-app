<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Privilege extends Model{
    
    use HasFactory;

    /********************
        ASOCIACIONES
    *********************/

    //Roles N:N
    public function roles(){
        return $this->belongsToMany(Role::class, "privileges_roles");
    }

}
