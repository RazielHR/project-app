<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Category;
use Illuminate\Http\Request;

//Excepciones de BD de laravel
use Illuminate\Database\QueryException;


//Clase para construir un validador personalizado
use Illuminate\Support\Facades\Validator;


class BookController extends Controller{

    //Constructor para asociar funcionalidad de inicio
    public function __construct() {

        // Asociar la policy de autorización al controller
        // https://laravel.com/docs/9.x/authorization#authorizing-resource-controllers
        /*
        Recibe como parámetros:
            + La clase del modelo a la cual está asociada la policy
            + El nombre del parámetro que representa al ID del modelo cuando se pasa en la URL 
        */
        $this->authorizeResource(Book::class, 'book');
        
    }

    //Genera una instancia del validador para crear/actualizar libros
    private function buildValidator($data){

        //Poner las reglas aparte para poder modificarlas previo a pasarlas al validador
        //https://laravel.com/docs/9.x/validation#available-validation-rules
        $rules = [
            "nombre" => ["bail", "required", "min:5", "max:50"],
            "siglas" => ["bail", "required", "max:255"],
            "descripcion" => ["bail", "nullable"],
            "duracion" => ["bail", "required", "min:0", "max:99999", "numeric"],
            "cupo" => ["bail", "required", "min:0", "max:99999", "numeric"],
            "ubicacion" => ["bail", "required", "max:255"],
            "costo" => ["bail", "required", "min:0", "max:99999", "numeric"],
            "fecha" => ["bail", "required", "max:255"],
        ];


        //https://laravel.com/docs/9.x/validation#manually-creating-validators
        $validator = Validator::make(
                $data, //Información a validar
                //Reglas a aplicar
                $rules,
                //Mensajes personalizados
                //https://laravel.com/docs/9.x/validation#manual-customizing-the-error-messages
                [
                    "required" => '":attribute" no puede estar vacío',
                    "nombre.min" => '":attribute" no puede ser menor a :min caracteres',
                    "nombre.max" => '":attribute" no puede ser mayor a :max caracteres',
                    "siglas.max" => '":attribute" no puede ser mayor a :max caracteres',
                    "descripcion.max" => '":attribute" no puede ser mayor a :max caracteres',
                    "min" => '":attribute" no puede ser menor a :min',
                    "max" => '":attribute" no puede ser mayor a :max',
                    "unique" => 'El valor de ":attribute" ya existe en el sistema',
                    "integer" => '":attribute" debe ser un número entero',
                    "numeric" => '":attribute" debe ser un número',
                    "exists" => '":attribute" debe existir en el sistema'
                ]
        );

        return $validator;

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
        
        $books = Book::orderBy("nombre", "asc")->get();

        return view("books.index", ["books" => $books]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(){
        $categories = Category::getAll();

        return view("books.create", [
            "categories" => $categories
        ]);
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request){

     
        $validator = $this->buildValidator($request->all());

        //Invocar el validador y verificar si falló
        if ($validator->fails()) {

            //dd($validator->errors());
            //https://laravel.com/docs/9.x/responses#redirecting-named-routes
            return redirect()->route("books.create")
                        //https://laravel.com/docs/9.x/validation#manually-creating-validators
                        ->withErrors($validator)
                        //https://laravel.com/docs/9.x/responses#redirecting-with-input
                        ->withInput();
            
        }

        //dd("valid");

        //Si los datos son válidos ejecutar el proceso

        //Procesamiento del archivo de portada
        //https://laravel.com/docs/9.x/filesystem#file-uploads


        try{

            //Guardar el libro
            $newBook = Book::create([
                "nombre" => $request->input("nombre"),
                "siglas" => $request->input("siglas"),
                "descripcion" => $request->input("descripcion"),
                "duracion" => $request->input("duracion"),
                "cupo" => $request->input("cupo"),
                "ubicacion" => $request->input("ubicacion"),
                "costo" => $request->input("costo"),
                "fecha" => $request->input("fecha")
            ]);

        }
        catch(QueryException $ex){
            echo($ex);
            //Algo salió mal, redirigir al catálogo de libros con mensaje de error
            //https://laravel.com/docs/9.x/responses#redirecting-named-routes
            return redirect()
                    ->route("books.index")
                    //https://laravel.com/docs/9.x/responses#redirecting-with-flashed-session-data
                    ->with("message", [
                        "type" => "error",
                        "text" => "Ha ocurrido un error al guardar el evento"
                    ]);

        }

       //Todo salió bien, redirigir al catálogo de libros
       //https://laravel.com/docs/9.x/responses#redirecting-named-routes
       return redirect()
                ->route("books.index")
                //https://laravel.com/docs/9.x/responses#redirecting-with-flashed-session-data
                ->with("message", [
                    "type" => "success",
                    "text" => "El evento se guardó exitosamente"
                ]);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function show(Book $book){
        
        return view("books.detail", ["book" => $book]);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function edit(Book $book){
        
        $categories = Category::getAll();

        return view("books.edit", [
            "book" => $book,
            "categories" => $categories
        ]);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Book $book){
        
        //validar los datos
        //Construir el validador
        $validator = $this->buildValidator($request->all(), "edit");

        //Invocar el validador y verificar si falló
        if ($validator->fails()) {

            //dd($validator->errors());
            //https://laravel.com/docs/9.x/responses#redirecting-named-routes
            return redirect()->route("books.edit", ["book" => $book->id])
                        //https://laravel.com/docs/9.x/validation#manually-creating-validators
                        ->withErrors($validator)
                        //https://laravel.com/docs/9.x/responses#redirecting-with-input
                        ->withInput();
            
        }


        //Verificar si se mandó una nueva portada, borrar la anterior y guardar la nueva


        //Verificar si viene el archivo en la petición
        //https://laravel.com/docs/9.x/requests#retrieving-uploaded-files


        //Actualizar el libro usando el modelo
        //https://laravel.com/docs/9.x/eloquent#updates
        $book->nombre = $request->input("nombre");
        $book->siglas = $request->input("siglas");
        //Para este caso, que puede ser nulo, se pasa como valor default el que ya tenía el libro
        $book->descripcion = $request->input("descripcion", $book->descripcion);
        $book->duracion = $request->input("duracion");
        $book->cupo = $request->input("cupo");
        $book->ubicacion = $request->input("ubicacion");
        $book->costo = $request->input("costo");
        $book->fecha = $request->input("fecha");

        //Se verificar si se guardó un nuevo archivo

        //Actualizar los autores y categorías

        //Borrar las asociaciones con autores
        //https://laravel.com/docs/9.x/eloquent-relationships#attaching-detaching

        //Crear las asociaciones con los autores enviados

        //Borrar las asociaciones con categorías
        //https://laravel.com/docs/9.x/eloquent-relationships#attaching-detaching
        $book->categories()->detach();

        //Crear las asociaciones con las categorías enviadas
        $book->categories()->attach($request->input("category"));

        //Guardar el libro
        $book->save();

        //Todo salió bien, redirigir al catálogo de libros
        //https://laravel.com/docs/9.x/responses#redirecting-named-routes
        return redirect()
            ->route("books.show", ["book" => $book->id])
            //https://laravel.com/docs/9.x/responses#redirecting-with-flashed-session-data
            ->with("message", [
                "type" => "success",
                "text" => "El evento se actualizó exitosamente"
            ]);
    
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function destroy(Book $book){
        
        //Usando el query builder
        //https://laravel.com/docs/9.x/queries#delete-statements
        //Book::where("id", "=", $id)->delete();

        //Usando la instancia del modelo
        $book->delete();
        //https://laravel.com/docs/9.x/responses#redirecting-named-routes
        //https://laravel.com/docs/9.x/responses#redirecting-with-flashed-session-data
        return redirect()
                ->route('books.index')
                ->with('message', [
                    "type" => "success",
                    "text" => "El evento se borró exitosamente"
                ]);

    }

}
