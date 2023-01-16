@foreach ($properties as $key => $value)
    @if ($key == "id" || $key == "idPoblacion" || $key == "activo")
        @continue
    @endif

    @include("components.forms.input", ["key" => $key, "value" => $value, "readOnly" => $STATE == "VIEW" || $STATE == "DELETE"])
@endforeach

@include("components.forms.input", [
    "key" => "activo",
    "value" => $properties["activo"],
    "required" => false,
    "readOnly" => $STATE == "VIEW" || $STATE == "DELETE"])