<div class="form-group">
    <label for="{{ $name }}">{{ $label }}</label>
    <input
        class="form-control @error($name) is-invalid @enderror"
        type="{{ $type ?? 'text' }}"
        name="{{ $name }}"
        id="{{ $name }}"
        @isset($valueData)
            value="{{ $valueData }}"
        @endisset
    />
    @error($name)
        <div class="invalid-feedback">
            {{ $message }}
        </div>
    @enderror
</div>
