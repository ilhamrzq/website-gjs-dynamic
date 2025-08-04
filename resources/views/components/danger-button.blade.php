<button {{ $attributes->merge(['type' => 'submit', 'class' => 'btn btn-soft-danger waves-effect waves-light']) }}>
    {{ $slot }}
</button>
