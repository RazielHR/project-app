@extends("layouts.main")

@section("pageTitle", "Error")

@section('mainContent')

    <div class="alert alert-danger">
        {{ $message }}
    </div>

@endsection