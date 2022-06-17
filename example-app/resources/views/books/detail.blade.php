@extends('layouts.main')

@section("pageTitle", "Detalle de Evento")

@push('styles')
    
    {{-- Page CSS --}}
    <link rel="stylesheet" href="{{ url("css/book.css") }}" />

@endpush

@section('mainContent')
    
    @if(session('message'))

        @php
            $message = session('message');
            $msgClass = ($message["type"] === "success") ? "success" : "danger";
        @endphp

        <div class="alert alert-{{ $msgClass }}">
            {{ $message["text"] }}
        </div>

    @endif
    
    <h2 class="mb-5"><?php echo($book->nombre); ?></h2>

    <div class="row mt-4">
        
        <div class="col-2 text-center">

            <h3 class="rounded-pill text-center py-3 mx-4 mt-4 price">
                ${{ $book->costo }}
            </h3>

            @can("update", $book)

                <a
                    href="{{ route('books.edit', ['book' => $book->id]) }}"
                    class="btn btn-warning mt-3"
                >
                    Editar
                </a>

            @endcan


        </div>

        <div class="col">

            <p>{{ $book->descripcion }}</p>

            <ul class="list-group list-group-flush details-list rounded-3 mt-4">
                <li class="list-group-item">
                    <strong class="me-2">Siglas:</strong>
                    <span>{{ $book->siglas }}</span>
                </li>
                <li class="list-group-item">
                    <strong class="me-2">Duración:</strong>
                    <span>{{ $book->duracion }} horas</span>
                </li>
                <li class="list-group-item">
                    <strong class="me-2">Cupo:</strong>
                    <span>{{ $book->cupo }} personas</span>
                </li>
                <li class="list-group-item">
                    <strong class="me-2">Ubicación:</strong>
                    <span>{{ $book->ubicacion }}</span>
                </li>
                <li class="list-group-item">
                    <strong class="me-2">Fecha:</strong>
                    <span>{{ $book->fecha }} </span>
                </li>
               
            </ul>

            <div class="keywords mt-5">

                @foreach($book->categories as $category)

                    <span class="badge rounded-pill px-3 py-2 me-2">
                        {{ $category->name }}
                    </span>

                @endforeach

            </div>

        </div>

    </div>

@endsection