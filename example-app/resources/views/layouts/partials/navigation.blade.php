<nav class="container-fluid navbar navbar-expand-md navbar-light position-sticky top-0">

    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <a class="navbar-brand d-md-none" href="#">Menu</a>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">

        <ul class="navbar-nav w-100 justify-content-center">
            <li class="nav-item">
                <a class="nav-link py-3 px-4 " href="{{ route('books.index') }}">Eventos</a>
            </li>
            @can('create', App\Models\Book::class)
            <li class="nav-item dropdown">
                <a 
                    class="nav-link dropdown-toggle py-3 px-4" 
                    id="booksDropdown" 
                    href="#" 
                    role="button"
                    data-bs-toggle="dropdown" 
                    aria-expanded="false"
                >
                    Registrar Evento
                </a>

                {{-- 
                @can se encarga de invocar el método de autorización correspondiente al primer 
                parámetro en la policy asociada al modelo pasado como segundo parámetro

                https://laravel.com/docs/9.x/authorization#via-blade-templates
                --}}
                
                    
                    <ul class="dropdown-menu m-0 border-0" aria-labelledby="booksDropdown">
                        <li>
                            <a class="dropdown-item text-center text-md-start" href="{{ route('books.create') }}">
                                Nuevo
                            </a>
                        </li>
                    </ul>

                @endcan

            </li>

            

            {{-- 
            Directivas de autenticación para saber si el usuario está o no logueado 
            https://laravel.com/docs/9.x/blade#authentication-directives
            --}}
            @auth
                
                <li class="nav-item dropdown position-absolute end-0">
                    <a 
                        class="nav-link dropdown-toggle py-3 px-4" 
                        href="#"
                        id="loginDropdown" 
                        href="#" 
                        role="button"
                        data-bs-toggle="dropdown" 
                        aria-expanded="false"
                    >
                        {{--
                        Para consultar los datos del usuario y de autenticación se puede usar el helper auth()
                        Laravel por defecto, al autenticar, crea una instancia de la clase User y la guarda en
                        la sesión, auth() tiene la capacidad de obtener esta instancia por medio del método user()

                        https://laravel.com/docs/9.x/helpers#method-auth
                        
                        --}}
                        {{ auth()->user()->name }}
                    </a>

                    <ul class="dropdown-menu m-0 border-0" aria-labelledby="loginDropdown">
                        <li>
                            <form action="{{ route("logout") }}" method="POST">

                                @csrf
                                <button class="dropdown-item text-center text-md-start" type="submit" >
                                    Cerrar sesión
                                </button>

                            </form>
                        </li>
                    </ul>

                </li>

            @endauth

            {{-- Valida que el el usuario no esté logueado --}}
            @guest
                
                <li class="nav-item position-absolute end-0 d-flex">
                    <a class="nav-link py-3 px-4" href="{{ route('login') }}">Login</a>
                </li>

            @endguest

        </ul>

    </div>

</nav>