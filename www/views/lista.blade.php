@extends('_partials.base')

@section('titulo')
{{ $title }}
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
                            @if ($userType == "REPAR")
                                <a href="enviosDetalle.php?id={{ $item["Envio_ID"] }}" type="button" class="btn btn-outline-info btn-sm" style="white-space: nowrap;">Ver</a>
                            @else
                                <a href="crudView.php?type={{ $type }}&id={{ $item["id"] ?? $item["Envio_ID"] ?? $item["DNI"] }}" type="button" class="btn btn-outline-info btn-sm" style="white-space: nowrap;">Ver</a>
                                <a href="crudEdit.php?type={{ $type }}&id={{ $item["id"] ?? $item["Envio_ID"] ?? $item["DNI"] }}" type="button" class="btn btn-outline-info btn-sm ms-2" style="white-space: nowrap;">Editar</a>
                                <a href="crudDelete.php?type={{ $type }}&id={{ $item["id"] ?? $item["Envio_ID"] ?? $item["DNI"] }}" type="button" class="btn btn-outline-info btn-sm ms-2" style="white-space: nowrap;">Borrar</a>
                            @endif
                        </td>
                    </tr>
                    @endforeach
            </tbody>
        </table>

        <div style="display: block; position: absolute; bottom: 5vh; right: 5vw;">
            <a href="crudCreate.php?type={{ $type }}" class="btn btn-primary rounded-circle fs-1" style="width: 70px; height: 70px; line-height: 55px" type="button">+</a>
        </div>
    @endif

    
</main>
@endsection