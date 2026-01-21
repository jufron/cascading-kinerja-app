<div class="form-group">
    <label for="{{ $name }}">{{ $label }}</label>
    <textarea
        class="form-control @error($name) is-invalid @enderror"
        id="{{ $name }}"
        name="{{ $name }}"
        @isset($rows)
        rows="{{ $rows }}"
        @else
        rows="5"
        @endisset
        spellcheck="false"
        @isset($placeholder)
        placeholder="{{ $placeholder }}"
        @endisset
    >@isset($slot){{ $slot }}@endisset</textarea>
    @error($name)
        <div class="invalid-feedback">
            {{ $message }}
        </div>
    @enderror
</div>
