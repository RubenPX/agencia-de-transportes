@foreach ($properties as $key => $value)
    @if ($key == "id" || substr($key, 0, 2) == "id" || $key == "extra")
        @continue
    @endif
    @include("components.forms.input", ["key" => $key, "value" => $value, "readOnly" => $STATE == "VIEW" || $STATE == "DELETE"])
@endforeach

@if ($STATE != "CREATE")
    @include("components.forms.select", [
        "readOnly" => $STATE == "VIEW" || $STATE == "DELETE",
        "key" => "idPoblacion",
        "CTitle" => "Pueblo",
        "value" => $properties["idPoblacion"],
        "required" => false,
        "items" => array_map(function($item) {
            return [
                "id" => $item["id"],
                "value" => $item["cp"] . " - " . $item["nombre"]
            ];
        }, $properties["extra"]["pueblos"]),
    ])
@endif