<?php

namespace App\Policies;

use App\Models\Author;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class AuthorPolicy{

    use HandlesAuthorization;

    /*
    Este método se ejecuta antes que cualquiera y lo usaremos para autorizar siempre
    al usuario administrador.

    https://laravel.com/docs/9.x/authorization#policy-filters
    */
    public function before(User $user, $ability){
        
        if ($user->isAdmin()) {
            return true;
        }
        //Devuelve falso ya que solo el administrado tiene acceso a las funciones de este
        // módulo
        return false;
    }


    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function viewAny(User $user)
    {
        //
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Author  $author
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, Author $author)
    {
        //
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Author  $author
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, Author $author)
    {
        //
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Author  $author
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, Author $author)
    {
        //
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Author  $author
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, Author $author)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Author  $author
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, Author $author)
    {
        //
    }
}
