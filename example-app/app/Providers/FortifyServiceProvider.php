<?php

namespace App\Providers;

use App\Actions\Fortify\CreateNewUser;
use App\Actions\Fortify\ResetUserPassword;
use App\Actions\Fortify\UpdateUserPassword;
use App\Actions\Fortify\UpdateUserProfileInformation;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\ServiceProvider;
use Laravel\Fortify\Fortify;

//Roles para pasar a la vista de registro
use App\Models\Role;


class FortifyServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Fortify::createUsersUsing(CreateNewUser::class);
        Fortify::updateUserProfileInformationUsing(UpdateUserProfileInformation::class);
        Fortify::updateUserPasswordsUsing(UpdateUserPassword::class);
        Fortify::resetUserPasswordsUsing(ResetUserPassword::class);

        RateLimiter::for('login', function (Request $request) {
            $email = (string) $request->email;

            return Limit::perMinute(5)->by($email.$request->ip());
        });

        RateLimiter::for('two-factor', function (Request $request) {
            return Limit::perMinute(5)->by($request->session()->get('login.id'));
        });

        //Indicar la vista que se utilizará para el login
        //https://laravel.com/docs/9.x/fortify#authentication
        Fortify::loginView(function () {
            return view('auth.login');
        });

        //Indicar la vista que se utilizará para el registro de usuarios
        //https://laravel.com/docs/9.x/fortify#registration
        Fortify::registerView(function () {
            
            //Obtener los roles en caso de que se quiera dar la oportunidad de elegir el rol
            $roles = Role::orderBy("name", "asc")->get();

            return view('auth.register', ["roles" => $roles]);

        });

    }
}
