<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Book extends Model{

    use HasFactory;

    public $timestamps = false;

    //Si mi tabla se llamara libros, tendría que crear este atributo
    //https://laravel.com/docs/9.x/eloquent#table-names
    //protected $table = "libros";

    //Indicar que se puede insertar en la tabla books pasando los siguientes campos en un arreglo
    //https://laravel.com/docs/9.x/eloquent#mass-assignment
    protected $fillable= [
        "nombre",
        "siglas",
        "descripcion",
        "duracion",
        "cupo",
        "ubicacion",
        "costo",
        "fecha"
  
    ];

    public function detailUrl(){

        return route("books.show", ["book" => $this->id]);

    }

    //Configurar la asociación N:N con categories
    //https://laravel.com/docs/9.x/eloquent-relationships#many-to-many
    public function categories(){
        return $this->belongsToMany(Category::class, 'books_categories');
    }


    //Devuelve un arreglo con los IDs de las categorías del libro
    public function categoriesIds(){

        //$this->authors devuelve una colección de objetos de la clase Author
        //https://laravel.com/docs/9.x/collections
        $ids = $this->categories->map(function($cat){
            //https://laravel.com/docs/9.x/collections#method-map
            //Definir a qué se va a mapear el elemento
            return $cat->id;
        });

        //Extraer el arreglo de la colección
        return $ids->all();

    }

}
