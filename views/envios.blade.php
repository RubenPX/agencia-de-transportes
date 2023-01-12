@extends('_partials.base')

@section('titulo')
Panel de envios de Repartidor
@endsection

@section('content')
<main class="container mt-3">

    <div class="text-center">
        <div class="h1 fw-light">Envios asignados a Tenerife</div>
    </div>

    <hr>

    <div class="text-center">
        <div class="h1 fw-light">En reparto</div>
    </div>

    <table class="table table-sm table-hover">
        <thead>
            <tr>
                <th scope="col" class="text-center align-middle">ID</th>
                <th scope="col" class="text-center align-middle">Fecha de envio</th>
                <th scope="col" class="text-center align-middle">Cliente</th>
                <th scope="col" class="text-center align-middle">Telefono cliente</th>
                <th scope="col" class="text-center align-middle">Dirección</th>
                <th scope="col" class="text-center align-middle" style="width: 150px;"></th>
            </tr>
        </thead>
        <tbody>

            <!-- Cliente 1 -->
            <tr>
                <th class="align-middle text-center text-center" scope="row">23</th>
                <th class="align-middle text-center text-center" scope="row">15 / Junio / 2022</th>
                <td class="align-middle text-center">Jorge Ribas</td>
                <td class="align-middle text-center">+34 123 123 123</td>
                <td class="align-middle ">
                    [[ Población ]] <br>
                    [[ Calle ]] <br>
                    [[ Piso ]]
                </td>
                <td class="align-middle text-center">
                    <a href="#Editar" type="button" class="btn btn-outline-info btn-sm mx-2" style="white-space: nowrap;">Completar entrega</a>
                </td>
            </tr>

            <!-- Cliente 2 -->
            <tr>
                <th class="align-middle text-center text-center" scope="row">24</th>
                <th class="align-middle text-center text-center" scope="row">15 / Junio / 2022</th>
                <td class="align-middle text-center">Dario Delta</td>
                <td class="align-middle text-center">+34 123 123 123</td>
                <td class="align-middle">
                    [[ Población ]] <br>
                    [[ Calle ]] <br>
                    [[ Piso ]]
                </td>
                <td class="align-middle text-center">
                    <a href="#Editar" type="button" class="btn btn-outline-info btn-sm mx-2" style="white-space: nowrap;">Completar entrega</a>
                </td>
            </tr>
        </tbody>
    </table>

    <div class="text-center">
        <div class="h1 fw-light">Entregado</div>
    </div>

    <table class="table table-sm table-hover">
        <thead>
            <tr>
                <th scope="col" class="text-center align-middle">ID</th>
                <th scope="col" class="text-center align-middle">Fecha de envio</th>
                <th scope="col" class="text-center align-middle">Cliente</th>
                <th scope="col" class="text-center align-middle">Telefono cliente</th>
                <th scope="col" class="text-center align-middle">Dirección</th>
                <th scope="col" class="text-center align-middle" style="width: 150px;"></th>
            </tr>
        </thead>
        <tbody>

            <!-- Cliente 1 -->
            <tr>
                <th class="align-middle text-center text-center" scope="row">23</th>
                <th class="align-middle text-center text-center" scope="row">15 / Junio / 2022</th>
                <td class="align-middle text-center">Jorge Ribas</td>
                <td class="align-middle text-center">+34 123 123 123</td>
                <td class="align-middle ">
                    [[ Población ]] <br>
                    [[ Calle ]] <br>
                    [[ Piso ]]
                </td>
                <td class="align-middle text-center">
                    <a href="#Editar" type="button" class="btn btn-outline-info btn-sm mx-2" style="white-space: nowrap;">Establecer "En reparto"</a>
                </td>
            </tr>

            <!-- Cliente 2 -->
            <tr>
                <th class="align-middle text-center text-center" scope="row">24</th>
                <th class="align-middle text-center text-center" scope="row">15 / Junio / 2022</th>
                <td class="align-middle text-center">Dario Delta</td>
                <td class="align-middle text-center">+34 123 123 123</td>
                <td class="align-middle ">
                    [[ Población ]] <br>
                    [[ Calle ]] <br>
                    [[ Piso ]]
                </td>
                <td class="align-middle text-center">
                    <a href="#Editar" type="button" class="btn btn-outline-info btn-sm mx-2" style="white-space: nowrap;">Establecer "En reparto"</a>
                </td>
            </tr>
        </tbody>
    </table>
</main>
@endsection