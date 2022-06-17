<?php

namespace App\Policies;

use App\Models\Book;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

// https://laravel.com/docs/9.x/authorization#creating-policies

// Si se pasa el parámetro --model=ModelName al comando de creación de la Policy
// se pre llenará con métodos asociados a los métodos del resource controller del
// modelo asociado
// https://laravel.com/docs/9.x/authorization#authorizing-resource-controllers

// La Policy debe registrarse en el service provider de autenticación
// https://laravel.com/docs/9.x/authorization#registering-policies

class BookPolicy {

    use HandlesAuthorization;

    /**
     * Perform pre-authorization checks.
     *
     * @param  \App\Models\User  $user
     * @param  string  $ability
     * @return void|bool
     */

    /*
    Este método se ejecuta antes que cualquiera y lo usaremos para autorizar siempre
    al usuario administrador.

    https://laravel.com/docs/9.x/authorization#policy-filters
    */
    public function before(User $user, $ability){
        
        if ($user->isAdmin()) {
            return true;
        }
        //Devuelve null para que se ejecute el método correspondiente a la acción del controller
        return null;
    }

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */

    /*
    El listado de libros es de acceso público, cuando queremos que el usuario anónimo
    tenga acceso a la funcionalidad, necesitamos indicarle a laravel que puede no haber
    usuario logueado para esta funcionalidad.
    Para ello se se asigna un valor nulo por defecto al usuario

    https://laravel.com/docs/9.x/authorization#guest-users
    */

    public function viewAny(User $user = null){
        //Devolver true siempre dado que es de acceso público
        return true;
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Auth\Access\Response|bool
     */

    // El detalle del libro es de acceso público
    public function view(User $user = null, Book $book){
        return true;
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */

    // Solo tiene acceso el administrador
    public function create(User $user){
        // No es necesario hacer nada ya que se maneja desde el before
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Auth\Access\Response|bool
     */
    // Solo tiene acceso el administrador
    public function update(User $user, Book $book){
        // No es necesario hacer nada ya que se maneja desde el before
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Auth\Access\Response|bool
     */

    // Solo tiene acceso el administrador
    public function delete(User $user, Book $book){
        // No es necesario hacer nada ya que se maneja desde el before
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, Book $book)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, Book $book)
    {
        //
    }

    //Método custom para validar los privilegios de la página de compra de un libro
    //Solo los usuarios logueados pueden comprar un libro
    public function buy(User $user){

        return $user->hasPrivilege("comprar_libros");

    }

}
