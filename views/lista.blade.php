@extends('_partials.base')

@section('titulo')
Panel de administrador
@endsection

@section('content')
<main class="container mt-3">

    @if ($error != "")
        <div class="alert alert-danger mb-0 mt-0">
            <p class="mb-0 text-center">{{ $error }}</p>
        </div>
    @else
        <table class="table table-sm table-hover">
            <thead>
                <tr>
                    @foreach ($properties as $item)
                        @foreach ($item as $key => $value)
                            <th scope="col" class="text-center align-middle">{{ $key }}</th>
                        @endforeach
                    @break
                    @endforeach
                    <th scope="col" class="text-center align-middle" style="width: 0;"></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($properties as $item)
                    <tr>
                        @foreach ($item as $key => $value)
                            <td class="align-middle text-center">{{ $value }}</td>
                        @endforeach
                        <td class="align-middle text-center d-flex">
                            <a href="#Borrar" type="button" class="btn btn-outline-info btn-sm" style="white-space: nowrap;">Ver</a>
                            <a href="#Borrar" type="button" class="btn btn-outline-info btn-sm ms-2" style="white-space: nowrap;">Editar</a>
                            <a href="#Borrar" type="button" class="btn btn-outline-info btn-sm ms-2" style="white-space: nowrap;">Borrar</a>
                        </td>
                    </tr>
                    @endforeach

                
            </tbody>
        </table>
    @endif

    
</main>
@endsection