@props(['status'])

@if ($status)
    <div {{ $attributes->merge(['class' => 'text-center mb-4 mx-lg-3']) }}>
        {{ $status }}
    </div>
@endif
