@extends('_partials.base')

@section('titulo')
Panel de administrador
@endsection

@section('content')
<main class="container mt-5">
    <div class="text-center">
        <div class="h1 fw-light">Bienvenido, {{ $logedUser }}</div>
    </div>
    <div class="text-center d-flex mt-5">
        <div class="card border-primary col m-2">
            <div class="card-body">
                <h3 class="card-title text-center">Clientes</h3>
                <button type="button" class="btn btn-info w-100">Acceder</button>
            </div>
        </div>
        <div class="card border-primary col m-2">
            <div class="card-body">
                <h3 class="card-title text-center">Repartidores</h3>
                <button type="button" class="btn btn-info w-100">Acceder</button>
            </div>
        </div>
        <div class="card border-primary col m-2">
            <div class="card-body">
                <h3 class="card-title text-center">Envíos</h3>
                <button type="button" class="btn btn-info w-100">Acceder</button>
            </div>
        </div>
        <div class="card border-primary col m-2">
            <div class="card-body">
                <h3 class="card-title text-center">Poblaciones</h3>
                <button type="button" class="btn btn-info w-100">Acceder</button>
            </div>
        </div>
    </div>
</main>
@endsection