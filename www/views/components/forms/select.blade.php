
{{-- inputs: $readOnly, $key, $CTitle, $value, $items { "id", "value" } --}}

<div class="form-group row mb-2">
    <label for="{{ $key }}" class="col-sm-4 col-form-label text-end">{{ $CTitle ?? $key }}</label>
    <div class="col-sm-8">
        @if ($readOnly)
            <select class="form-select" disabled name="{{ $key }}" id="{{ $key }}" aria-label="Default select example">
                @if (isset($value) && $value == "")
                    <option value="" selected></option>
                @endif
                @foreach ($items as $item)
                        <option value="{{ $item["id"] }}" @if($item["id"] == $value) selected @endif>{{ $item["value"] }}</option>
                @endforeach
            </select>
        @else
            <select class="form-select" required name="{{ $key }}" id="{{ $key }}" aria-label="Default select example">
                @if (isset($value) && $value == "")
                    <option value="" selected></option>
                @endif
                @foreach ($items as $item)
                        <option value="{{ $item["id"] }}" @if($item["id"] == $value) selected @endif>{{ $item["value"] }}</option>
                @endforeach
            </select>
        @endif
    </div>
</div>