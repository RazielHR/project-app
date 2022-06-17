<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

//Importar controllers para manejar la lógica en archivos independientes
use App\Http\Controllers\TestController;
use App\Http\Controllers\AuthorController;
use App\Http\Controllers\BookController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/*
La clase Route de laravel es la encargada de definir las rutas que se usarán en la apliación.
Entre otros métodos, cuenta con un método estático para cada posible acción de HTTP:
post, get, put, delete, patch, etc.
*/

/*
La ruta más básica de PHP recibe:
    + Un string con el path (relativo al dominio de la aplicación) con el que se hará match
    + Una función anónima (closure) que funcionará como controlador a ejecutarse al cargar la ruta
      en el navegador.
La función controladora debe devolver una respuesta que se mandará en el navegador (típicamente HTML)
*/
//Route::get('/', function () {
    /*
    "view" es un método predefinido (helper) de Laravel que devuelve el contenido de una vista que debe
    estar almacenada en el directorio "resources/views".
    
    El patrón de nombre de las vistas es "{viewName}.blade.php, el string pasado como parámetro a la 
    función "view" corresponde a {viewName}.
    
    La extensión ".blade" se debe a que el "template engine" usado por laravel se llama "Blade".
    */
    //return view('welcome');
//});

// Ruta de reirección para que al entrar a "/" me mande a "/books"
//https://laravel.com/docs/9.x/routing#redirect-routes
Route::redirect('/', '/books');

//Ruta para "about-us"
// Route::get("/about-us", function(){
//     return "<h1>Acerca de nosotros</h1>";
// });

// //Laravel siempre toma la última ruta que haga match con la escrita en el navegador
// Route::get("/about-us", function(){
//     return view("aboutUs");
// });

/*
Cuando la función controladora no ejecutará ninguna lógica más que devolver una vista estática,
se puede usar como "atajo" el método estático "view" que funcionará como un get que hace un
return de una vista.
*/
Route::view("/about-us", "aboutUs");

/* 
Los métodos estáticos post, get, delete, patch, put, etc. de la clase "Route" tienen 
una sintaxis alternativa para que las rutas puedan ser vinculadas a métodos definidos
en controladores en lugar de a funciones anónimas definidas en la misma routa (closures).

En esta sintaxis el segundo parámetro pasa de ser una función a ser un arreglo de
exactamente dos localidades:
    + En la primera irá el nombre de la clase del controlador que manejará la lógica.
    + En la segunda el nombre del método, de ese controlador, que se ejecutará al 
      cargar la ruta.
Previo a esto el controlador debió ser importado con "use" (ver al inicio de este archivo)
*/
Route::get("/test", [TestController::class, "doSomething"]);

//Las rutas pueden ejecutar el método "name" que permite asociar nombres como "alias"
//a ellas
Route::get("authors", [AuthorController::class, "otherMethod"])->name("authors.other");

// Las rutas con el prefijo "books" que no sean parte de la resource route (CRUD) se deben
// definir antes de la resource route

/*
Cuando se crea un controller usando "artisan", la línea de comandos de laravel (php artisan 
make:controller --resource AuthorController), se crea una clase controller prellenada
con las firmas de los métodos para un CRUD, estos métodos tienen nombres estándar que
le permiten a laravel inferir la configuración de las rutas que se tendrían que hacer para 
ellos, por lo tanto es posible indicar a laravel que genere TODAS las rutas necesarias
para los métodos de este tipo de controllers con la siguiente instrucción.

El método "resource" solo recibe la clase del resource controller para el cual generará las
rutas, no necesita saber el nombre de los métodos dado que estos son los métodos estándar 
de laravel.
*/

//https://laravel.com/docs/9.x/controllers#actions-handled-by-resource-controller
// Route::resource('authors', AuthorController::class);
// Route::resource('books', BookController::class);
Route::resources([
  'authors' => AuthorController::class,
  'books' => BookController::class
]);



//Crear autores





