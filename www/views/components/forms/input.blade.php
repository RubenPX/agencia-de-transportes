
{{-- inputs: $key, $value, $CTitle, $type, $readOnly --}}

<div class="form-group row mb-2">
    <label for="{{ $key }}" class="col-sm-4 col-form-label text-end">{{ $CTitle ?? $key }}</label>
    <div class="col-sm-8">
        @if (gettype($value) == "string")
            @if ($readOnly)
                <input type="{{ $type ?? "text" }}" readonly disabled class="form-control-plaintext" id="{{ $key }}" name="{{ $key }}" value="{{ $value }}">
            @else
                <input type="{{ $type ?? "text" }}" required class="form-control" id="{{ $key }}" name="{{ $key }}" value="{{ $value }}">
            @endif
        @endif

        @if (gettype($value) == "boolean")
            @if ($readOnly)
                <div class="form-check form-switch mt-2">
                    <input class="form-check-input" disabled type="checkbox" id="{{ $key }}" name="{{ $key }}" @if($value) checked @endif>
                </div>
            @else
                <div class="form-check form-switch mt-2">
                    <input class="form-check-input" required type="checkbox" id="{{ $key }}" name="{{ $key }}" @if($value) checked @endif>
                </div>
            @endif
        @endif
    </div>
</div>