{{-- <button {{ $attributes->merge(['type' => 'submit', 'class' => 'mobile-full-width btn btn-primary mt-3']) }}>
    {{ $slot }}
</button> --}}

<button {{ $attributes->merge(['type' => 'submit', 'class' => 'mobile-full-width btn btn-primary mt-3']) }}
    onclick="showLoading(this)">
    <span class="button-text">{{ $slot }}</span>
    <span class="button-loading d-none">
        <span class="spinner-border spinner-border-sm me-2" role="status" aria-hidden="true"></span>
        {{ $loadingText ?? 'Loading...' }}
    </span>
</button>

<script>
    function showLoading(button) {
        // Hide the original text and show loading
        button.querySelector('.button-text').classList.add('d-none');
        button.querySelector('.button-loading').classList.remove('d-none');

        // Disable the button to prevent multiple clicks
        button.disabled = true;

        // Optional: Add a slight delay to ensure form submission
        setTimeout(() => {
            // If it's a submit button, the form will submit automatically
            // If you need to manually submit, you can do it here
            if (button.type === 'submit' && button.form) {
                button.form.submit();
            }
        }, 100);
    }
</script>
