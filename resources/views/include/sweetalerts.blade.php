{{-- validasi kalo ngga lolos, masuknya ke objek errors bukan ke session('error') --}}
{{-- session()->has('error') nampilin error di controller selain validasi --}}

@if ($errors->any() || session()->has('error') || session()->has('success'))
    <script>
        $(document).ready(function() {
            @if ($errors->any())
                var message = {!! json_encode($errors->first()) !!};
                var html =
                    '<div class="mt-3"><lord-icon src="https://cdn.lordicon.com/tdrtiskw.json" trigger="loop" colors="primary:#f06548,secondary:#f7b84b" style="width:120px;height:120px"></lord-icon><div class="mt-4 pt-2 fs-15"><h4>Oops...! Something went Wrong !</h4><p class="text-muted mx-4 mb-0">' +
                    message + '</p></div></div>'
                var messageType = "error";
            @elseif (session()->has('error'))
                var message = {!! json_encode(session('error')) !!};
                var html =
                    '<div class="mt-3"><lord-icon src="https://cdn.lordicon.com/tdrtiskw.json" trigger="loop" colors="primary:#f06548,secondary:#f7b84b" style="width:120px;height:120px"></lord-icon><div class="mt-4 pt-2 fs-15"><h4>Oops...! Something went Wrong !</h4><p class="text-muted mx-4 mb-0">' +
                    message + '</p></div></div>'
                var messageType = "error";
            @elseif (session()->has('success'))
                var message = {!! json_encode(session('success')) !!};
                var html =
                    '<div class="mt-3"><lord-icon src="https://cdn.lordicon.com/awmkozsb.json" trigger="loop" colors="primary:#0ab39c,secondary:#212529" style="width:120px;height:120px"></lord-icon><div class="mt-4 pt-2 fs-15"><h4>Well done !</h4><p class="text-muted mx-4 mb-0">' +
                    message + '</p></div></div>'
                var messageType = "success";
            @endif

            Swal.fire({
                html: html,
                buttonsStyling: false,
                showCloseButton: true,
                customClass: {
                    confirmButton: "btn btn-primary w-xs mt-2",
                }
            });
        });
    </script>
@endif

<script>
    function confirmDelete(event, encryptedId) {
        event.preventDefault();
        Swal.fire({
            html: '<div class="mt-3"><lord-icon src="https://cdn.lordicon.com/gsqxdxog.json" trigger="loop" colors="primary:#f7b84b,secondary:#f06548" style="width:100px;height:100px"></lord-icon><div class="mt-4 pt-2 fs-15 mx-5"><h4>Are you Sure ?</h4><p class="text-muted mx-4 mb-0">This action will delete the data</p></div></div>',
            showCancelButton: !0,
            confirmButtonText: "Yes, Delete It!",
            buttonsStyling: !1,
            showCloseButton: !0,
            customClass: {
                confirmButton: "btn btn-ghost-danger waves-effect waves-light w-xs me-2 mb-1",
                cancelButton: "btn btn-danger w-xs mb-1"
            }
        }).then((result) => {
            if (result.isConfirmed) {
                $('#deleteForm' + encryptedId).submit();
            }
        });

    }
</script>
