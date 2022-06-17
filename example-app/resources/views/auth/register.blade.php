@extends('layouts.main')

@section("pageTitle", "Login")

@push('styles')

    {{-- Page CSS --}}
    <link rel="stylesheet" href="{{ url("css/register.css") }}" />
            
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
            Se debe hacer un post a "/register"
            El formulario debe tener los siguientes campos (con exactamente esos names):
                - name
                - email
                - password
                - password_confirmation
            --}}

            <form 
                action="{{ route("register") }}" 
                method="post" 
                id="loginForm" 
                class="mx-auto mt-sm-5 w-75"
                novalidate
            >

                @csrf

                <div class="form-group mb-3">
                    <label for="name">Nombre</label>
                    <input 
                        type="text" 
                        class="form-control" 
                        id="name" 
                        name="name" 
                        value="{{ old("name") }}"
                        required 
                    />
                </div>

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

                <div class="form-group mb-3">
                    <label for="password_confirmation">Confirmar contraseña</label>
                    <input 
                        type="password" 
                        class="form-control" 
                        id="password_confirmation" 
                        name="password_confirmation" 
                        value=""
                        required 
                    />
                </div>

                {{-- 
                Esto solo sería en caso de que se quisiera poner un dropdown con los roles
                
                <div class="form-group mb-3">
                    
                    <label for="publisher">Rol</label>
                
                    <select class="form-select w-50" id="publisher" name="publisher" required>
        
                        @foreach($roles as $role)
        
                            <option value="{{ $role->id }}" @selected(old('role') == $role->id) >
                                {{ $role->name }}
                            </option>
                        
                        @endforeach
        
                    </select>
                
                </div> 
                --}}

                <div class="form-group mt-4">
                    <button type="submit" class="btn btn-primary">Registrar</button>
                </div>

            </form>

        </div>
    
    </div>

@endsection