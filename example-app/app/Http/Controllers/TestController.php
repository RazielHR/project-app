<?php

/*
Este es un controller creado manualmente.

Un controller simple no es más que una clase ubicada en el directorio "app/Http/Controllers"
dentro del namespace "App\Http\Controllers" que define una serie de métodos que 
posteriormente serán asociados a rutas en el archivo de routing.

Idealmente debería extender de la clase "Controller" que se encuentra en el mismo
directorio pero esto no es mandatorio.
*/

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

class TestController{


    public function doSomething(){

        echo DB::connection()->getDatabaseName();

    }

}
