@extends('layouts.main')

@section("pageTitle", "Login")

@push('styles')

    {{-- Page CSS --}}
    <link rel="stylesheet" href="{{ url("css/login.css") }}" />
            
@endpush

@section("mainContent")

    @if ($errors->any())

        @foreach ($errors->all() as $error)
            <div class="alert alert-danger">{{ $error }}</div>
        @endforeach

    @endif

    <div class="card w-50 mx-auto my-5">

        <div class="card-body">

            {{-- 
            Debe mandar un post a la ruta con alias "login" ("/login") 
            El post debe incluir los siguientes datos:
                - email
                - password
                - remember (oculto)
            --}}

            <form 
                action="{{ route("login") }}" 
                method="post" 
                id="loginForm" 
                class="mx-auto mt-sm-5 w-75"
                novalidate
            >

                @csrf

                <div class="form-group mb-3">
                    <label for="email">Correo electrónico</label>
                    <input 
                        type="text" 
                        class="form-control" 
                        id="email" 
                        name="email" 
                        value="{{ old("email") }}"
                        required 
                    />
                </div>

                <div class="form-group mb-3">
                    <label for="password">Contraseña</label>
                    <input 
                        type="password" 
                        class="form-control" 
                        id="password" 
                        name="password" 
                        value=""
                        required 
                    />
                </div>

                {{-- 
                Se pone esto como oculto porque no nos interesa configurarlo pero es requerido 
                le damos el valor de falso (0) por defecto
                --}}
                <input type="hidden" value="0" name="remember" />

                <div class="form-group mt-4">
                    <button type="submit" class="btn btn-primary">Entrar</button>
                </div>

            </form>

        </div>
    
    </div>

@endsection