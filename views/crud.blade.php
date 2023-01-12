@extends('_partials.base')

@section('titulo')
Panel de administrador
@endsection

@section('content')
<main class="container px-5 my-5">
    <div class="row justify-content-center">
        <div class="col-lg-8">

            @if (isset($error) && $error != "")
                <div class="alert alert-danger mb-0 mt-0">
                    <p class="mb-0 text-center">{{ $error }}</p>
                </div>
            @else
                <div class="card border-0 rounded-3 shadow-lg">
                    <div class="card-body p-4">
                        <div class="text-center pb-2">
                            <h1 class="h1 fw-light">{{ $title }}</h1>
                        </div>

                        <form id="contactForm" method="POST">
                            @foreach ($properties as $key => $value)
                                @if ($key == "id" || $key == "idPoblacion")
                                    @continue
                                @endif
                                <div class="form-group row mb-2">
                                    <label for="staticEmail" class="col-sm-3 col-form-label text-end">{{ $key }}</label>
                                    <div class="col-sm-9">
                                        @if (gettype($value) == "string")
                                            @if ($STATE == "READ")
                                                <input type="text" readonly disabled class="form-control-plaintext" id="staticEmail" value="{{ $value }}">
                                            @else
                                                <input type="text" class="form-control" id="staticEmail" value="{{ $value }}">
                                            @endif
                                        @endif

                                        @if (gettype($value) == "boolean")
                                            @if ($STATE == "READ")
                                                <div class="form-check form-switch mt-2">
                                                    <input class="form-check-input" disabled type="checkbox" id="flexSwitchCheckChecked" checked="">
                                                </div>
                                            @else
                                                <div class="form-check form-switch mt-2">
                                                    <input class="form-check-input" type="checkbox" id="flexSwitchCheckChecked" checked="">
                                                </div>
                                            @endif
                                        @endif
                                    </div>
                                </div>
                            @endforeach

                            <input id="from" name="from" type="hidden" value="{{ $properties['id'] ?? $properties['DNI'] ?? $properties['DNI'] }}" />

                            <!-- Submit button -->
                            <div class="d-flex mt-4" style="justify-content: space-between">
                                @if ($STATE == "READ")
                                    <button class="btn btn-primary btn-lg w-100" id="submitButton" type="submit">Cerrar</button>
                                @else
                                    <a class="btn btn-primary btn-lg" href="listadoclientes.php">Cancelar</a>
                                    <button class="btn btn-primary btn-lg" id="submitButton" type="submit">Guardar</button>
                                @endif
                            </div>
                        </form>
                    </div>
                </div>
            @endif
        </div>
    </div>
</main>
@endsection