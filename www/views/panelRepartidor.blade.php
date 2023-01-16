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

                    <div class="form-group row">
                        <label for="completed" class="col-sm-6 col-form-label">No recogido</label>
                        <div class="col-sm-6">
                            <input type="text" readonly class="form-control-plaintext" id="completed" value="3">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="finished" class="col-sm-6 col-form-label">recogido</label>
                        <div class="col-sm-6">
                            <input type="text" readonly class="form-control-plaintext" id="finished" value="5">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="finished" class="col-sm-6 col-form-label">en reparto</label>
                        <div class="col-sm-6">
                            <input type="text" readonly class="form-control-plaintext" id="finished" value="5">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="finished" class="col-sm-6 col-form-label">Entregados</label>
                        <div class="col-sm-6">
                            <input type="text" readonly class="form-control-plaintext" id="finished" value="5">
                        </div>
                    </div>

                    <a href="lista.php?type=Envio" type="button" class="btn btn-info w-100 mt-3">Ver repartos</a>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection