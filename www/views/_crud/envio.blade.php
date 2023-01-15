@include("components.forms.select", [
    "readOnly" => $STATE == "VIEW" || $STATE == "DELETE",
    "key" => "idRemitente",
    "title" => "Remitente",
    "value" => $properties["idRemitente"],
    "items" => array_map(function($item) {
        return [
            "id" => $item["id"],
            "value" => $item["nombre"] . " " . $item["apellidos"] . $properties["idRemitente"]
        ];
    }, $properties["extra"]["remitentes"]),
])


@include("components.forms.select", [
    "readOnly" => ($STATE == "VIEW" || $STATE == "DELETE"),
    "key" => "idDestinatario",
    "title" => "Destinatario",
    "value" => $properties["idDestinatario"],
    "items" => array_map(function($item) {
        return [
            "id" => $item["id"],
            "value" => $item["nombre"] . " " . $item["apellidos"]
        ];
    }, $properties["extra"]["destinatarios"]),
])

@foreach ($properties as $key => $value)
    @if (!in_array($key, ["DNICliente"]))
        @continue
    @endif

    @include("components.forms.input", ["key" => $key, "value" => $value, "readOnly" => $STATE == "VIEW" || $STATE == "DELETE"])
@endforeach

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