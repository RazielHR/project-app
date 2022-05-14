@extends("layouts.main")

@section('pageTitle', "Roles")

{{-- Estilos personalizados --}}
@push('styles')

  <link rel="stylesheet" href="./css/index.css" />

@endpush

@section('mainContent')


<table class="table table-striped">
    <tr class="table-primary">
        <th class="table-primary">Nombre</td>
        <th class="table-secondary">Rol</td>
        <th class="table-success">Acciones</td>
        <th class="table-success">
            <button class="btn btn-link">
            <i class="bi bi-person-plus"></i>
            </button>
        </td>
    </tr>
    <tr class="table-light">
        <td>Alfreds Futterkiste</td>
        <td>Administrador</td>
        <td><i class="bi bi-pencil"></i>
        <i class="bi bi-x-lg"></i>
    </td>
    <td></td>

    </tr>
    <tr class="table-light">
        <td>Alfreds Futterkiste</td>
        <td>Operador</td>
        <td><i class="bi bi-pencil"></i>
        <i class="bi bi-x-lg"></i>
    </td>
    <td></td>

    </tr>
</table>

@endsection