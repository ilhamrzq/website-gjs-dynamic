@props(['message'])

@if ($message)
<div class="alert alert-danger alert-border-left alert-dismissible fade show mb-xl-0" role="alert">
    <i class="ri-error-warning-line me-3 align-middle fs-16"></i><strong>Error:</strong>
    <div>
        {{ $message }}
    </div>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif