@extends('layouts.main')

@section("pageTitle", "Editar Evento - " . $book->nombre)

@push('styles')

    {{-- Page CSS --}}
    <link rel="stylesheet" href="{{ url("css/editBook.css") }}" />
            
@endpush

@section("mainContent")

    <h2>Editar Evento</h2>

    @if(session('message'))

        @php
            $message = session('message');
            $msgClass = ($message["type"] === "success") ? "success" : "danger";
        @endphp

        <div class="alert alert-{{ $msgClass }}">
            {{ $message["text"] }}
        </div>
    
    @endif
    
    {{-- 
    Desplegar errores de validación
    https://laravel.com/docs/9.x/validation#quick-displaying-the-validation-errors
     --}}
    @if($errors->any())
        
        @foreach($errors->all() as $error)
            <div class="alert alert-danger">{{ $error }}</div>
        @endforeach
    
    @endif

    <form 
        action="{{ route("books.update", ["book" => $book->id]) }}" 
        method="post" 
        enctype="multipart/form-data" 
        id="newBookForm" 
        class="mx-auto mt-sm-5"
        novalidate
    >

        @csrf

        {{-- 
        Method spoofing, usado para sobreescribir el método del formulario por uno que no es soportado
        por HTML
        https://laravel.com/docs/9.x/blade#method-field
        --}}
        @method("PUT")

        <div class="form-group mb-3">
            <label for="nombre">Nombre</label>
            <input 
                type="text" 
                class="form-control" 
                id="nombre" 
                name="nombre" 
                {{-- https://laravel.com/docs/9.x/helpers#method-old --}}
                value="{{ old("nombre", $book->nombre) }}"
                required 
            />
        </div>

        <div class="form-group mb-3">
            <label for="siglas">Siglas</label>
            <input 
                type="text" 
                class="form-control" 
                id="siglas" 
                name="siglas" 
                value="{{ old("siglas", $book->siglas) }}"
                required 
            />
        </div>

        <div class="form-group mb-3">
            <label for="summary">Descripcion</label>
            <textarea class="form-control" id="descripcion" name="descripcion" >{{ old("descripcion", $book->descripcion) }}</textarea>
        </div>
        
        <div class="form-group mb-3">
            <label for="duracion">Duracion (horas)</label>
            <input 
                type="number" 
                class="form-control w-25" 
                id="duracion" 
                name="duracion" 
                step="1" 
                value="{{ old("duracion", $book->duracion) }}"
                required 
            />
        </div>

        <div class="form-group mb-3">
            <label for="cupo">Cupo (núm. de personas)</label>
            <input 
                type="number" 
                class="form-control w-25" 
                id="cupo" 
                name="cupo" 
                step="1" 
                value="{{ old("cupo", $book->cupo) }}"
                required 
            />
        </div>

        <div class="form-group mb-3">
            <label for="ubicacion">Ubicación</label>
            <input 
                type="text" 
                class="form-control" 
                id="ubicacion" 
                name="ubicacion" 
                value="{{ old("ubicacion", $book->ubicacion) }}"
                required 
            />
        </div>

        <div class="form-group mb-3">
            <label for="costo">Costo</label>
            <input 
                type="number" 
                class="form-control w-25" 
                id="costo" 
                name="costo" 
                step="0.1" 
                value="{{ old("costo", $book->costo) }}"
                required 
            />
        </div>


        <div class="form-group mb-3">
            <label for="fecha">Fecha</label>
            <input 
                type="text" 
                class="form-control" 
                id="fecha" 
                name="fecha" 
                value="{{ old("fecha", $book->fecha) }}"
                required 
            />
        </div>

        <div class="form-group mb-3">
            <label for="category">Categorías</label>

            <div class="mt-3 categories-list">
                
                @foreach($categories as $category)
                
                    <div class="form-check form-check-inline">
                        
                        <input 
                            class="form-check-input" 
                            type="checkbox" 
                            name="category[{{ $category->id }}]" 
                            id="category_{{ $category->id }}" 
                            value="{{ $category->id }}" 
                            @checked(
                                in_array(
                                    $category->id, 
                                    old('category', $book->categoriesIds())
                                )
                            )
                        />

                        <label class="form-check-label" for="category_{{ $category->id }}">
                            {{ $category->name }}
                        </label>
                    
                    </div>

                @endforeach
                
            </div>
            
        </div>

        <div class="form-group mt-4">
            <button type="submit" class="btn btn-primary">Guardar</button>
        </div>

    </form>

@endsection

@push('scripts')

@endpush