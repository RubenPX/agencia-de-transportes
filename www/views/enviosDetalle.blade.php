@extends('_partials.base')

@section('titulo')
Detalles de envio
@endsection

@section('content')
<main class="my-5 mt-3">
    <div class="row me-0 ms-0 justify-content-center">
        <div class="col-md-12 col-lg-10 col-xl-9">

            @if (isset($error) && $error != "")
                <div class="alert alert-danger mb-0 mt-0">
                    <p class="mb-0 text-center">{{ $error }}</p>
                </div>
            @else
                <div class="text-center pb-2">
                    <h1 class="h1 fw-light">{{ $title }}</h1>
                </div>

                <div class="row">
                    <div class="col-md-6 col-sm-12 p-2">
                        <div class="card border-0 rounded-3 shadow-lg">
                            <div class="card-body p-4">
                                <div class="text-center pb-2">
                                    <h3 class="h3 fw-light">Datos de envio</h3>
                                </div>

                                @include("components.forms.input", ["key" => "Peso", "value" => $properties["Envio_Peso"] . " Kg", "readOnly" => true])
                                @include("components.forms.input", ["key" => "Ancho", "value" => $properties["Envio_Ancho"] . " Cm", "readOnly" => true])
                                @include("components.forms.input", ["key" => "Largo", "value" => $properties["Envio_Largo"] . " Cm", "readOnly" => true])
                                @include("components.forms.input", ["key" => "Alto", "value" => $properties["Envio_Alto"] . " Cm", "readOnly" => true])
                                @include("components.forms.input", ["key" => "Tarifa", "value" => $properties["Envio_Tarifa"], "readOnly" => true])

                            </div>
                        </div>
                    </div>
    
                    <div class="col-md-6 col-sm-12 p-2">
                        <div class="card border-0 rounded-3 shadow-lg">
                            <div class="card-body p-4">
                                <div class="text-center pb-2">
                                    <h3 class="h3 fw-light">Datos de cliente</h3>
                                </div>

                                @include("components.forms.input", ["key" => "Nombre", "value" => $properties["Cli_Nombre"] . " " . $properties["Cli_Apellidos"], "readOnly" => true])
                                @include("components.forms.input", ["key" => "Mail", "value" => $properties["Cli_Mail"], "readOnly" => true])
                                @include("components.forms.input", ["key" => "Telefono", "value" => $properties["Cli_Telefono"], "readOnly" => true])
                                
                            </div>
                        </div>
                    </div>
    
                    <div class="col-md-6 col-sm-12 p-2">
                        <div class="card border-0 rounded-3 shadow-lg">
                            <div class="card-body p-4">
                                <div class="text-center pb-2">
                                    <h3 class="h3 fw-light">Datos de remitente</h3>
                                </div>

                                @include("components.forms.input", ["key" => "Nombre", "value" => $properties["Re_Nombre"], "readOnly" => true])
                                @include("components.forms.input", ["key" => "Correo", "value" => $properties["Re_Correo"], "readOnly" => true])
                                @include("components.forms.input", ["key" => "Telefono", "value" => $properties["Re_Telefono"], "readOnly" => true])
                                @include("components.forms.input", ["key" => "Dirección", "value" => $properties["Re_CP"] . " - " . $properties["Re_Ciudad"] . " " . $properties["Re_Calle"], "readOnly" => true])
                                                                
                            </div>
                        </div>
                    </div>
    
                    <div class="col-md-6 col-sm-12 p-2">
                        <div class="card border-0 rounded-3 shadow-lg">
                            <div class="card-body p-4">
                                <div class="text-center pb-2">
                                    <h3 class="h3 fw-light">Datos de destinatario</h3>
                                </div>

                                @include("components.forms.input", ["key" => "Nombre", "value" => $properties["Dest_Nombre"], "readOnly" => true])
                                @include("components.forms.input", ["key" => "Correo", "value" => $properties["Dest_Correo"], "readOnly" => true])
                                @include("components.forms.input", ["key" => "Telefono", "value" => $properties["Dest_Telefono"], "readOnly" => true])
                                @include("components.forms.input", ["key" => "Dirección", "value" => $properties["Dest_CP"] . " - " . $properties["Dest_Ciudad"] . " " . $properties["Dest_Calle"], "readOnly" => true])

                            </div>
                        </div>
                    </div>

                    <div class="col-md-6 col-sm-12 p-2 pb-0">
                        <div class="input-group mb-3">
                            <select class="form-select" id="exampleSelect1">
                                <option>no recogido</option>
                                <option>recogido</option>
                                <option>en reparto</option>
                                <option>entregado</option>
                            </select>
                            <button class="btn btn-primary btn-lg" type="button" id="button-addon2">Cambiar estado</button>
                        </div>
                    </div>

                    <div class="col-md-6 col-sm-12 p-2">
                        <a class="btn btn-primary btn-lg w-100" href="lista.php?type=Envio">Cerrar</a>
                    </div>
                </div>

                    
            @endif
        </div>
    </div>
</main>
@endsection