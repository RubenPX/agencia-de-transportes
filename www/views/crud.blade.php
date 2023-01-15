@extends('_partials.base')

@section('titulo')
{{ $title }}
@endsection

@section('content')
<main class="container px-5 my-5">
    <div class="row justify-content-center">
        <div class="col-lg-8">

            @if (isset($error) && $error != "")
                <div class="alert alert-danger mb-0 mt-0">
                    <p class="mb-0 text-center">{{ $error }}</p>
                </div>
            @elseif (isset($ok) && $ok != "")
                <div class="alert alert-success mb-0 mt-0">
                    <p class="mb-0 text-center">{{ $ok }}</p>
                </div>

                <a class="btn btn-primary btn-lg mt-3 w-100" href="lista.php?type={{ $type }}">Volver</a>
            @else
                <div class="card border-0 rounded-3 shadow-lg">
                    <div class="card-body p-4">
                        <div class="text-center pb-2">
                            <h1 class="h1 fw-light">{{ $title }}</h1>
                        </div>

                        <form id="contactForm" method="POST">
                            @include('_crud.' . strtolower($type))

                            <input id="from" name="from" type="hidden" value="{{ $properties['id'] ?? $properties['DNI'] }}" />

                            <!-- Submit button -->
                            <div class="d-flex mt-4" style="justify-content: space-between">
                                @if ($STATE == "VIEW")
                                    <a class="btn btn-primary btn-lg" href="lista.php?type={{ $type }}">Cerrar</a>
                                    <a class="btn btn-primary btn-lg" href="crudEdit.php?type={{ $type }}&id={{ $id }}">Editar</a>
                                @elseif ($STATE == "CREATE")
                                    <a class="btn btn-primary btn-lg" href="lista.php?type={{ $type }}">Cancelar</a>
                                    <button class="btn btn-primary btn-lg" name="CREATE" id="submitButton" type="submit">Crear</button>
                                @elseif ($STATE == "DELETE")
                                    <a class="btn btn-primary btn-lg" href="lista.php?type={{ $type }}">Cancelar</a>
                                    <button class="btn btn-primary btn-lg" name="DELETE" id="submitButton" type="submit">Eliminar</button>
                                @elseif ($STATE == "UPDATE")
                                    <a class="btn btn-primary btn-lg" href="lista.php?type={{ $type }}">Cancelar</a>
                                    <button class="btn btn-primary btn-lg" name="EDIT" id="submitButton" type="submit">Guardar</button>
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