{{--  
La directiva @extends indica el layout que se usará como base para inyectar el
contenido de esta vista en secciones específicas del layout indicadas por @yield
y @stack.
--}}
@extends('layouts.main')

{{-- 
La directiva @section indica el contenido que se inyectará en las secciones definidas
con @yield en el layout.
--}}
@section('pageTitle', "Acerca de nosotros") 

{{--
@section tiene una segunda sintaxis con un tag de apertura y cierre para agregar contenido
más extenso dentro de la sección    
--}}
@section('mainContent')
    
    <h1 class="text-center mb-4" >Acerca de nosotros</h1>

    <p>
        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce libero libero, 
        lobortis quis lacinia a, pretium a leo. Ut facilisis congue fringilla. Cras 
        egestas scelerisque dolor. Etiam eu sapien dapibus, vehicula lorem ut, placerat 
        nunc. Duis nec mauris dictum, rutrum urna vitae, tincidunt eros. Fusce elementum 
        efficitur felis, vitae feugiat sem vulputate eu. Cras scelerisque tincidunt mi 
        eget faucibus. Ut massa mi, tempus sit amet neque vel, fermentum volutpat nisl. 
        Cras varius pulvinar turpis, ut efficitur purus tempus in.
    </p>

    <p>
        Duis tempor erat odio, at blandit nulla fermentum at. Ut at mattis nisi, quis 
        eleifend libero. Pellentesque varius imperdiet velit sed facilisis. Fusce orci 
        urna, vehicula non varius euismod, suscipit non risus. Proin feugiat porta 
        tortor, in dictum augue faucibus eget. Aenean tristique ligula eu justo mattis, 
        eu pharetra ex tempor. Maecenas porta a tortor sit amet dignissim. Etiam vitae 
        dignissim metus, ut lobortis eros. Fusce quis porta velit. Mauris auctor vitae 
        turpis in porta. Nullam tempor neque in turpis faucibus ullamcorper. Suspendisse 
        viverra diam at mi porttitor mattis. Donec scelerisque ullamcorper ullamcorper. 
        Praesent viverra arcu a quam accumsan, et porta leo commodo. Nullam imperdiet, 
        felis vel tempor cursus, nibh turpis ornare massa, id blandit purus nibh at libero. 
        Mauris at ipsum vitae leo facilisis faucibus.
    </p>

@endsection

@push('scripts')
    
    <script>
        console.log("test");
    </script>

@endpush