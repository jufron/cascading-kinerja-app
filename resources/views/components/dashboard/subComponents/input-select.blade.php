<div class="form-group">
    <label for="{{ $name }}">{{ $label }}</label>
      <select name="{{ $name }}" class="custom-select @error($name) is-invalid @enderror" id="{{ $name }}">
        {{ $slot }}
      </select>
    @error($name)
        <div class="invalid-feedback">
            {{ $message }}
        </div>
    @enderror
</div>
