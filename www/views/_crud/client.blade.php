@foreach ($properties as $key => $value)
    @if ($key == "id" || $key == "idPoblacion")
        @continue
    @endif

    @include("components.forms.input", ["key" => $key, "value" => $value, "readOnly" => $STATE == "VIEW" || $STATE == "DELETE"])
@endforeach