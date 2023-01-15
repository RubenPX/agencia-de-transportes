
{{-- inputs: $readOnly, $key, $title, $value, $items { "id", "value" } --}}

<div class="form-group row mb-2">
    <label for="{{ $key }}" class="col-sm-4 col-form-label text-end">{{ $title }}</label>
    <div class="col-sm-8">
        @if ($readOnly)
            <input type="text" readonly disabled class="form-control-plaintext" id="staticEmail" value="{{ $items[$value]["value"] }}">
        @else
            <select class="form-select" name="{{ $key }}" id="{{ $key }}" aria-label="Default select example">
                @foreach ($items as $item)
                        <option value="{{ $item["id"] }}" @if($item["id"] == $value) selected @endif>{{ $item["value"] }}</option>
                @endforeach
            </select>
        @endif
    </div>
</div>