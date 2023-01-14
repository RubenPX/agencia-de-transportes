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
                <h3 class="card-title text-center">Ciudad asignada</h3>
                <h4 class="card-text text-center">Tenerife</h4>
            </div>
        </div>
        <div class="row col-12 pl-7 ps-5 pe-0 w-100">
            <div class="card border-primary col m-2">
                <div class="card-body">
                    <h3 class="card-title text-center">Datos del repartidor</h3>
                    <div class="form-group row">
                        <label for="name" class="col-sm-3 col-form-label">Nombre</label>
                        <div class="col-sm-9">
                            <input type="text" readonly="" class="form-control-plaintext" id="name" value="{{ $logedUser }}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="email" class="col-sm-3 col-form-label">Email</label>
                        <div class="col-sm-9">
                            <input type="text" readonly="" class="form-control-plaintext" id="email" value="email@example.com">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="phone" class="col-sm-3 col-form-label">telefono</label>
                        <div class="col-sm-9">
                            <input type="text" readonly="" class="form-control-plaintext" id="phone" value="+34 123 123 123">
                        </div>
                    </div>
                    <a type="button" class="btn btn-info w-100 mt-2" href="#Edit_Profile">Editar perfil</a>
                </div>
            </div>
            <div class="card border-primary col m-2">
                <div class="card-body">
                    <h3 class="card-title text-center mb-4">Repartos</h3>

                    <div class="form-group row mb-2 pb-1">
                        <label for="completed" class="col-sm-6 col-form-label">Pendientes</label>
                        <div class="col-sm-6">
                            <input type="text" readonly class="form-control-plaintext" id="completed" value="3">
                        </div>
                    </div>
                    <div class="form-group row mb-2 pb-1">
                        <label for="finished" class="col-sm-6 col-form-label">Entregados</label>
                        <div class="col-sm-6">
                            <input type="text" readonly class="form-control-plaintext" id="finished" value="5">
                        </div>
                    </div>

                    <a href="envios.php" type="button" class="btn btn-info w-100 mt-2">Ver repartos</a>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection