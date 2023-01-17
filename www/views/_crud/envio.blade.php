@include("components.forms.select", [
    "readOnly" => $STATE == "VIEW" || $STATE == "DELETE",
    "key" => "idRemitente",
    "CTitle" => "Remitente",
    "value" => $properties["idRemitente"],
    "items" => array_map(function($item) {
        return [
            "id" => $item["id"],
            "value" => $item["nombre"] . " " . $item["apellidos"]
        ];
    }, $properties["extra"]["remitentes"]),
])


@include("components.forms.select", [
    "readOnly" => ($STATE == "VIEW" || $STATE == "DELETE"),
    "key" => "idDestinatario",
    "CTitle" => "Destinatario",
    "value" => $properties["idDestinatario"],
    "items" => array_map(function($item) {
        return [
            "id" => $item["id"],
            "value" => $item["nombre"] . " " . $item["apellidos"]
        ];
    }, $properties["extra"]["destinatarios"]),
])

@include("components.forms.select", [
    "readOnly" => ($STATE == "VIEW" || $STATE == "DELETE"),
    "key" => "DNICliente",
    "value" => $properties["DNICliente"],
    "items" => array_map(function($item) {
        return [
            "id" => $item["DNI"],
            "value" => $item["DNI"] . " - " .  $item["nombre"] . " " . $item["apellidos"]
        ];
    }, $properties["extra"]["clientes"]),
])

@include("components.forms.input", [
    "key" => "fecha",
    "value" => $properties["fecha"],
    "CTitle" => "Fecha",
    "type" => "date",
    "readOnly" => $STATE == "VIEW" || $STATE == "DELETE"
])

@foreach ($properties as $key => $value)
    @if (!in_array($key, ["peso", "ancho", "largo", "alto"]))
        @continue
    @endif

    @include("components.forms.input", [
        "key" => $key,
        "value" => $value,
        "CTitle" => $key . ( $key == "peso" ? " (Kg)" : " (Cm)" ),
        "type" => "number",
        "readOnly" => $STATE == "VIEW" || $STATE == "DELETE"
    ])
@endforeach

@include("components.forms.input", [
    "key" => "tarifa",
    "value" => $properties["tarifa"],
    "CTitle" => "Tarifa",
    "readOnly" => $STATE == "VIEW" || $STATE == "DELETE"
])

@include("components.forms.select", [
    "readOnly" => ($STATE == "VIEW" || $STATE == "DELETE" || $STATE == "CREATE"),
    "key" => "estado",
    "CTitle" => "Estado",
    "value" => $properties["estado"] == "" ? "1" : $properties["estado"],
    "items" => array_map(function($item) {
        return [
            "id" => $item["id"],
            "value" => $item["tipo"]
        ];
    }, $properties["extra"]["estados"]),
])