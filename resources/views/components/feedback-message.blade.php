@props(['field'])

@if ($errors->has($field))
 <div class="invalid-feedback mt-2">
        {{ $errors->first($field) }}
    </div>
@endif
