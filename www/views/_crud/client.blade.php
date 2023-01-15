@foreach ($properties as $key => $value)
    @if ($key == "id" || $key == "idPoblacion")
        @continue
    @endif
    <div class="form-group row mb-2">
        <label for="{{ $key }}" class="col-sm-3 col-form-label text-end">{{ $key }}</label>
        <div class="col-sm-9">
            @if (gettype($value) == "string")
                @if ($STATE == "VIEW")
                    <input type="text" readonly disabled class="form-control-plaintext" id="{{ $key }}" name="{{ $key }}" value="{{ $value }}">
                @else
                    <input type="text" class="form-control" id="{{ $key }}" name="{{ $key }}" value="{{ $value }}">
                @endif
            @endif

            @if (gettype($value) == "boolean")
                @if ($STATE == "VIEW")
                    <div class="form-check form-switch mt-2">
                        <input class="form-check-input" disabled type="checkbox" id="{{ $key }}" name="{{ $key }}" @if($properties["activo"]) checked @endif>
                    </div>
                @else
                    <div class="form-check form-switch mt-2">
                        <input class="form-check-input" type="checkbox" id="{{ $key }}" name="{{ $key }}" @if($properties["activo"]) checked @endif>
                    </div>
                @endif
            @endif
        </div>
    </div>
@endforeach