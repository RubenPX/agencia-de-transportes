<?php array_unshift($properties["extra"]["repartidores"], ["id" => "", "Nombre" => " ", "Apellidos" => " "]) ?>

@foreach ($properties as $key => $value)
    @if ($key == "id" || substr($key, 0, 2) == "id" || $key == "extra")
        @continue
    @endif

    @include("components.forms.input", [
        "key" => $key,
        "value" => $value,
        "readOnly" => $STATE == "VIEW" || $STATE == "DELETE"
    ])
@endforeach

@if ($STATE != "CREATE")
    @include("components.forms.select", [
        "readOnly" => ($STATE == "VIEW" || $STATE == "DELETE"),
        "key" => "idRepartidor",
        "CTitle" => "Repartidor",
        "value" => $properties["idRepartidor"],
        "required" => false,
        "items" => array_map(function($item) {
            return [
                "id" => $item["id"],
                "value" => $item["Nombre"] . " " . $item["Apellidos"]
            ];
        }, $properties["extra"]["repartidores"]),
    ])
@endif

