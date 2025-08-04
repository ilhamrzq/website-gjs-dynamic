@props(['button',  'target' => ''])
<button {{ $attributes->merge(['class' => 'btn']) }} type="{{ $button ?? 'button' }}" data-bs-toggle="modal" data-bs-target="#{{ $target }}">
    {{ $slot }}
</button>