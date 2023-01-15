<div class="form-group row mb-2">
    <label for="idRemitente" class="col-sm-3 col-form-label text-end">Remitente</label>
    <div class="col-sm-9">
        @if ($STATE == "VIEW" || $STATE == "DELETE")
            <input type="text" readonly disabled class="form-control-plaintext" id="staticEmail" value="{{ $properties["idRemitente"] }}">
        @else
            <select class="form-select" name="idRemitente" id="idRemitente" aria-label="Default select example">
                @foreach ($properties["extra"]["remitentes"] as $item)
                        <option value="{{ $item["id"] }}">{{ $item["nombre"] }}</option>
                @endforeach
            </select>
        @endif
    </div>
</div>

<div class="form-group row mb-2">
    <label for="idDestinatario" class="col-sm-3 col-form-label text-end">Destinatario</label>
    <div class="col-sm-9">
        @if ($STATE == "VIEW" || $STATE == "DELETE")
            <input type="text" readonly disabled class="form-control-plaintext" id="staticEmail" value="{{ $properties["idDestinatario"] }}">
        @else
            <select class="form-select" name="idDestinatario" id="idDestinatario" aria-label="Default select example">
                @foreach ($properties["extra"]["destinatarios"] as $item)
                        <option value="{{ $item["id"] }}">{{ $item["nombre"] }}</option>
                @endforeach
            </select>
        @endif
    </div>
</div>

<div class="form-group row mb-2">
    <label for="fecha" class="col-sm-3 col-form-label text-end">Fecha</label>
    <div class="col-sm-9">
        @if ($STATE == "VIEW" || $STATE == "DELETE")
                <input type="date" readonly disabled class="form-control-plaintext" id="fecha" value="{{ $properties["fecha"] }}">
            @else
                <input type="date" class="form-control" id="fecha" name="fecha" value="{{ $properties["fecha"] }}">
            @endif
    </div>
</div>

@foreach ($properties as $key => $value)
    @if (!in_array($key, ["peso", "ancho", "largo", "alto"]))
        @continue
    @endif
    <div class="form-group row mb-2">
        <label for="{{ $key }}" class="col-sm-3 col-form-label text-end">{{ $key }}
        
            @if ($key == "peso")
                (Kg)
            @else
                (Cm)
            @endif

        </label>
        <div class="col-sm-9">
            @if ($STATE == "VIEW" || $STATE == "DELETE")
                <input type="number" readonly disabled class="form-control-plaintext" id="{{ $key }}" value="{{ $value }}">
            @else
                <input type="number" class="form-control" id="{{ $key }}" name="{{ $key }}" value="{{ $value }}">
            @endif
        </div>
    </div>
@endforeach

