@props(['messages'])

@if ($messages)
    {{-- <ul> --}}
        {{-- @foreach ((array) $messages as $message)
            <li {{ $attributes->merge(['class' => 'text-danger']) }}>{{ $message }}</li>
        @endforeach --}}
    {{-- </ul> --}}

    @foreach ((array) $messages as $message)
        <div {{ $attributes->merge(['class' => 'text-danger']) }} class="invalid-feedback mt-2">
            {{ $message }}
        </div>
    @endforeach
@endif
