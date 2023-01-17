@extends('_partials.base')

@section('titulo')
Panel de repartidor
@endsection

@section('content')
<main class="container mt-3">
    <div class="text-center pb-2">
        <div class="h1 fw-light">Bienvenido, {{ $logedUser }}</div>
    </div>

    <div class="row">
        <div class="card border-primary col-12 m-2">
            <div class="card-body">
                <h3 class="card-title text-center">Población asignada</h3>
                <h4 class="card-text text-center">{{ $properties["pueblo"] }}</h4>
            </div>
        </div>
        <div class="row col-12 pl-7 ps-5 pe-0 w-100">
            <div class="card border-primary col m-2">
                <div class="card-body">
                    <h3 class="card-title text-center mb-3">Repartos</h3>

                    <a href="lista.php?type=Envio" type="button" class="btn btn-info w-100 mt-3">Ver repartos</a>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection