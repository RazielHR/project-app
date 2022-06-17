{{-- Layout principal de la aplicación --}}
<!DOCTYPE html>
<html lang="es">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        {{-- 
        La directiva @yield indica que en este lugar se inyectará el contenido de la @section 
        definida con el mismo nombre el la página hija.
        --}}
        <title>@yield('pageTitle')</title>

        {{--
        ***********************************
                        CSS
        ***********************************
        Solo se incluyen los estilos generales
        de la aplicación
        --}}
        
        {{--Bootstrap--}}
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">
        
        {{--Main CSS--}}
        <link rel="stylesheet" href="{{ url("css/main.css") }}" />

        {{-- 
        Se coloca in stack para agregar cualquier otro estilo que provenga de las páginas hijas.

        Un stack permite definir una sección con contenido en el layout a la cual posteriormente 
        se le podrá hacer "append" de contenido adicional
        --}}
        @stack('styles')
        
    </head>

    <body>
        
        {{-- 
        Partial del header 
        
        la directiva @include permite incluir una "subvista" en la vista actual heredando todas
        las variables de la vista padre. También se le puede pasar un arreglo como segundo parámetro
        con datos adicionales.
        --}}
        @include('layouts.partials.header')

        {{-- Partial de navegación principal --}}
        @include('layouts.partials.navigation')
        
        {{-- Contenido principal --}}
        <main class="container-fluid py-5 mb-5">

            @yield("mainContent")
            
        </main>

        {{-- Partial del footer --}}
        @include('layouts.partials.footer')
        
    </body>

    {{--
    *******************************
            JAVASCRIPT
    *******************************
    Solo los scripts generales de la
    aplicación
    --}}
    
    {{-- JQuery --}}
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    {{-- Bootstrap --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-U1DAWAznBHeqEIlVSCgzq+c9gqGAJn5c/t99JyeKa9xxaYpSvHU5awsuZVVFIhvj" crossorigin="anonymous"></script>

    {{-- Stack para scripts adicionales de las vistas hijas --}}
    @stack("scripts")

</html>