@extends("layouts.main")

@section('pageTitle', "Lista de Eventos")

{{-- Estilos personalizados --}}
@push('styles')

  <link rel="stylesheet" href="./css/index.css" />

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

    <div class="card-group justify-content-center books-container">

        @forelse($books as $book)

            <div class="card mx-3 border-0 text-center my-3">

                <div class="card-header">
                {{ $book->siglas }}
                </div>


                <div class="card-body">
                    <h5 class="card-title">
                        {{ $book->nombre }}
                    </h5>

                    <p class="card-text">
                        Fecha: 
                        {{ $book->fecha }}
                    </p>
                    <p class="card-text">
                        Costo:
                        ${{ $book->costo }}
                    </p>
                </div>

                <div class="card-footer d-flex justify-content-center">
                    <a 
                        href="{{ $book->detailUrl() }}" 
                        class="btn btn-primary"
                        target="_blank"
                    >
                        Detalle
                    </a>

                    @can("delete", $book)

                        <form 
                            action="{{ route("books.destroy", ["book" => $book->id]) }}" 
                            method="POST" 
                            class="ms-3" 
                        >

                            @csrf
                            @method("DELETE")
                            {{-- <input type="hidden" value="DELETE" name="_method" /> --}}

                            <button type="submit" class="btn btn-danger">
                                Eliminar
                            </button>
                        
                        </form>

                    @endcan

                </div>

            </div>

        @empty

            <div class="alert alert-warning">No se encontraron eventos</div>

        @endforelse

    </div>

@endsection