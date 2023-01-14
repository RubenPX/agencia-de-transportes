@extends('_partials.base')

@section('titulo')
Detalles de envio
@endsection

@section('content')
<main class="my-5 mt-3">
    <div class="row me-0 ms-0 justify-content-center">
        <div class="col-lg-8">

            @if (isset($error) && $error != "")
                <div class="alert alert-danger mb-0 mt-0">
                    <p class="mb-0 text-center">{{ $error }}</p>
                </div>
            @else
                <div class="text-center pb-2">
                    <h1 class="h1 fw-light">{{ $title }}</h1>
                </div>

                <div class="row">
                    <div class="col-6 p-2">
                        <div class="card border-0 rounded-3 shadow-lg">
                            <div class="card-body p-4">
                                <div class="text-center pb-2">
                                    <h3 class="h3 fw-light">Datos de envio</h3>
                                </div>
        
                                <div class="form-group row mb-2">
                                    <label for="staticEmail" class="col-sm-3 col-form-label text-end">Peso</label>
                                    <div class="col-sm-9">
                                        <input type="text" readonly disabled class="form-control-plaintext" id="staticEmail" value="{{ $properties["Envio_Peso"] }} Kg">
                                    </div>
                                </div>

                                <div class="form-group row mb-2">
                                    <label for="staticEmail" class="col-sm-3 col-form-label text-end">Ancho</label>
                                    <div class="col-sm-9">
                                        <input type="text" readonly disabled class="form-control-plaintext" id="staticEmail" value="{{ $properties["Envio_Ancho"] }} cm">
                                    </div>
                                </div>

                                <div class="form-group row mb-2">
                                    <label for="staticEmail" class="col-sm-3 col-form-label text-end">Largo</label>
                                    <div class="col-sm-9">
                                        <input type="text" readonly disabled class="form-control-plaintext" id="staticEmail" value="{{ $properties["Envio_Largo"] }} cm">
                                    </div>
                                </div>

                                <div class="form-group row mb-2">
                                    <label for="staticEmail" class="col-sm-3 col-form-label text-end">Alto</label>
                                    <div class="col-sm-9">
                                        <input type="text" readonly disabled class="form-control-plaintext" id="staticEmail" value="{{ $properties["Envio_Alto"] }} cm">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="staticEmail" class="col-sm-3 col-form-label text-end">Tarifa</label>
                                    <div class="col-sm-9">
                                        <input type="text" readonly disabled class="form-control-plaintext" id="staticEmail" value="{{ $properties["Envio_Tarifa"] }}">
                                    </div>
                                </div>
                                
                            </div>
                        </div>
                    </div>
    
                    <div class="col-6 p-2">
                        <div class="card border-0 rounded-3 shadow-lg">
                            <div class="card-body p-4">
                                <div class="text-center pb-2">
                                    <h3 class="h3 fw-light">Datos de cliente</h3>
                                </div>
        
                                <div class="form-group row mb-2">
                                    <label for="staticEmail" class="col-sm-3 col-form-label text-end">Nombre</label>
                                    <div class="col-sm-9">
                                        <input type="text" readonly disabled class="form-control-plaintext" id="staticEmail" value="{{ $properties["Cli_Nombre"] }} {{ $properties["Cli_Apellidos"] }}">
                                    </div>
                                </div>

                                <div class="form-group row mb-2">
                                    <label for="staticEmail" class="col-sm-3 col-form-label text-end">Correo</label>
                                    <div class="col-sm-9">
                                        <input type="text" readonly disabled class="form-control-plaintext" id="staticEmail" value="{{ $properties["Cli_Mail"] }}">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="staticEmail" class="col-sm-3 col-form-label text-end">Telefono</label>
                                    <div class="col-sm-9">
                                        <input type="text" readonly disabled class="form-control-plaintext" id="staticEmail" value="{{ $properties["Cli_Telefono"] }}">
                                    </div>
                                </div>
                                
                            </div>
                        </div>
                    </div>
    
                    <div class="col-6 p-2">
                        <div class="card border-0 rounded-3 shadow-lg">
                            <div class="card-body p-4">
                                <div class="text-center pb-2">
                                    <h3 class="h3 fw-light">Datos de remitente</h3>
                                </div>
        
                                <div class="form-group row mb-2">
                                    <label for="staticEmail" class="col-sm-3 col-form-label text-end">Nombre</label>
                                    <div class="col-sm-9">
                                        <input type="text" readonly disabled class="form-control-plaintext" id="staticEmail" value="{{ $properties["Re_Nombre"] }}">
                                    </div>
                                </div>

                                <div class="form-group row mb-2">
                                    <label for="staticEmail" class="col-sm-3 col-form-label text-end">Correo</label>
                                    <div class="col-sm-9">
                                        <input type="text" readonly disabled class="form-control-plaintext" id="staticEmail" value="{{ $properties["Re_Correo"] }}">
                                    </div>
                                </div>

                                <div class="form-group row mb-2">
                                    <label for="staticEmail" class="col-sm-3 col-form-label text-end">Telefono</label>
                                    <div class="col-sm-9">
                                        <input type="text" readonly disabled class="form-control-plaintext" id="staticEmail" value="{{ $properties["Re_Telefono"] }}">
                                    </div>
                                </div>

                                <div class="form-group row mb-2">
                                    <label for="staticEmail" class="col-sm-3 col-form-label text-end">Dirección</label>
                                    <div class="col-sm-9">
                                        <input type="text" readonly disabled class="form-control-plaintext" id="staticEmail" value="{{ $properties["Re_CP"] }} - {{ $properties["Re_Ciudad"] }} {{ $properties["Re_Calle"] }}">
                                    </div>
                                </div>
                                
                            </div>
                        </div>
                    </div>
    
                    <div class="col-6 p-2">
                        <div class="card border-0 rounded-3 shadow-lg">
                            <div class="card-body p-4">
                                <div class="text-center pb-2">
                                    <h3 class="h3 fw-light">Datos de destinatario</h3>
                                </div>

                                <div class="form-group row mb-2">
                                    <label for="staticEmail" class="col-sm-3 col-form-label text-end">Nombre</label>
                                    <div class="col-sm-9">
                                        <input type="text" readonly disabled class="form-control-plaintext" id="staticEmail" value="{{ $properties["Dest_Nombre"] }}">
                                    </div>
                                </div>

                                <div class="form-group row mb-2">
                                    <label for="staticEmail" class="col-sm-3 col-form-label text-end">Correo</label>
                                    <div class="col-sm-9">
                                        <input type="text" readonly disabled class="form-control-plaintext" id="staticEmail" value="{{ $properties["Dest_Correo"] }}">
                                    </div>
                                </div>

                                <div class="form-group row mb-2">
                                    <label for="staticEmail" class="col-sm-3 col-form-label text-end">Telefono</label>
                                    <div class="col-sm-9">
                                        <input type="text" readonly disabled class="form-control-plaintext" id="staticEmail" value="{{ $properties["Dest_Telefono"] }}">
                                    </div>
                                </div>

                                <div class="form-group row mb-2">
                                    <label for="staticEmail" class="col-sm-3 col-form-label text-end">Dirección</label>
                                    <div class="col-sm-9">
                                        <input type="text" readonly disabled class="form-control-plaintext" id="staticEmail" value="{{ $properties["Dest_CP"] }} - {{ $properties["Dest_Ciudad"] }} {{ $properties["Dest_Calle"] }}">
                                    </div>
                                </div>
                                
                            </div>
                        </div>
                    </div>

                    <div class="col-6 p-2">
                        <a class="btn btn-primary btn-lg w-100" href="lista.php?type=Envio">Cerrar</a>
                    </div>

                    <div class="col-6 p-2">
                        
                        <div class="input-group mb-3">
                            <select class="form-select" id="exampleSelect1">
                                <option>no recogido</option>
                                <option>recogido</option>
                                <option>en reparto</option>
                                <option>entregado</option>
                              </select>
                            <button class="btn btn-primary btn-lg" type="button" id="button-addon2">Aplicar</button>
                          </div>
                    </div>
                </div>

                    
            @endif
        </div>
    </div>
</main>
@endsection