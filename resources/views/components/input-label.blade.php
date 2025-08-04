{{-- @props(['value'])

<label {{ $attributes->merge(['class' => 'block font-medium text-sm text-gray-700 dark:text-gray-300']) }}>
    {{ $value ?? $slot }}
</label> --}}

@props(['value', 'error' => null])

<label {{ $attributes->merge(['class' => 'form-label']) }}>
    {{ $value ?? $slot }}
</label>
