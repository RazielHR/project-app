<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    //Devuelve todas las editoriales ordenadas por nombre
    public static function getAll(){

        return Category::select("id", "name")->orderBy("name", "asc")->get();

    }

}
