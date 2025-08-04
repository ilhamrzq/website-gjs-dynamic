<!-- JAVASCRIPT -->
<script src="{{ asset('/assets/libs/bootstrap/js/bootstrap.bundle.min.js') }} "></script>
<script src="{{ asset('/assets/libs/simplebar/simplebar.min.js') }} "></script>
<script src="{{ asset('/assets/libs/node-waves/waves.min.js') }} "></script>
<script src="{{ asset('/assets/libs/feather-icons/feather.min.js') }} "></script>
<script src="{{ asset('/assets/js/pages/plugins/lord-icon-2.1.0.js') }} "></script>
<script src="{{ asset('/assets/js/plugins.js') }} "></script>

<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>


<!-- dropzone min -->
<script src="{{ asset('/assets/libs/dropzone/dropzone-min.js') }}"></script>


<!--datatable js-->
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.2/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.print.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.html5.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>

<!-- apexcharts -->
<script src="{{ asset('/assets/libs/apexcharts/apexcharts.min.js') }} "></script>

<!-- Vector map-->
<script src="{{ asset('/assets/libs/jsvectormap/js/jsvectormap.min.js') }} "></script>
<script src="{{ asset('/assets/libs/jsvectormap/maps/world-merc.js') }} "></script>

<!--Swiper slider js-->
<script src="{{ asset('/assets/libs/swiper/swiper-bundle.min.js') }}"></script>

<!-- Dashboard init -->
<script src="{{ asset('/assets/js/pages/dashboard-ecommerce.init.js') }}"></script>

<!-- Select2 -->
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script src="{{ asset('/assets/js/pages/select2.init.js') }}"></script>

<!-- Sweet Alerts js -->
<script src="{{ asset('/assets/libs/sweetalert2/sweetalert2.min.js') }}"></script>

<!-- Sweet alert init js-->
<script src="{{ asset('/assets/js/pages/sweetalerts.init.js') }}"></script>

<!-- App js -->
<script src="{{ asset('/assets/js/app.js') }} "></script>

<!-- Check All Data for delete -->
<script>

    // ---- START - Global Scope Function ----

        // ____ START Quantity + - ____
        function isData() {
            document.addEventListener("click", function (e) {
                let target = e.target;

                if (target.classList.contains("plus")) {
                    let input = target.previousElementSibling;
                    if (parseInt(input.value) < input.getAttribute("max")) {
                        input.value++;
                    }
                }

                if (target.classList.contains("minus")) {
                    let input = target.nextElementSibling;
                    if (parseInt(input.value) > input.getAttribute("min")) {
                        input.value--;
                    }
                }
            });
        }
        isData();
        // ____ END Quantity + - ____

        // ____ START format pricing _____
            $("input[data-format='currency']").on("input", function() {
                let value = $(this).val().replace(/\D/g, ""); // Hanya angka (hapus non-digit)
                if (value) {
                    $(this).val(new Intl.NumberFormat("id-ID").format(value)); // Format ribuan
                }
            });

            // Sebelum form dikirim, ubah format angka ke angka asli tanpa titik
            $("form").on("submit", function() {
                $("input[data-format='currency']").each(function() {
                    let rawValue = $(this).val().replace(/\./g, ""); // Hapus titik
                    $(this).val(rawValue);
                });
            });
        // ____ END format pricing _____

        // START ____ Multiple Delete Function____

            // Form Check - header table
            $('#checkAll').on('change', function () {
                console.log("Check ALL");
                $('.checkbox-row').prop('checked', this.checked);
                deleteButton();
            });

            // Form Check - row data
            $(document).on('change', '.checkbox-row', function () {
                if (!this.checked) {
                    $('#checkAll').prop('checked', false);
                } else {
                    if ( $('.checkbox-row:checked').length === $('.checkbox-row').length ) {
                        $("#checkAll").prop('checked', true);
                    }
                }
                deleteButton();
            });

            // Multiple Delete Button
            function deleteButton() {
                let checkedRows = $('.checkbox-row:checked').length;
                if (checkedRows > 0) {
                    $('#deleted-data').html(`
                        <form id="bulk-delete-form" action="javascript:void(0);" method="POST">
                            <button type="submit" class="btn btn-outline-danger btn-label waves-effect waves-light ms-md-2 mt-3 mt-md-0">
                                <i class="ri-delete-bin-2-fill label-icon align-middle fs-16 me-2"></i>Delete ` + checkedRows + ` items
                            </button>
                        </form>`);
                } else {
                    $('#deleted-data').html('');
                }
            }

            // Handle bulk delete
            function multipleDelete(routeMultipleDelete, idDataTables) {
                $(document).on('submit', '#bulk-delete-form', function(e) {
                    e.preventDefault();
                    let selectedRows = $('.checkbox-row:checked').map(function() {
                        return this.value;
                    }).get();
                    console.log("selected ", selectedRows);

                    if (selectedRows.length === 0) {
                        Swal.fire('Warning', 'Please select at least one row to delete.', 'warning');
                        return;
                    }

                    // SweetAlert confirmation
                    Swal.fire({
                        html: '<div class="mt-3"><lord-icon src="https://cdn.lordicon.com/gsqxdxog.json" trigger="loop" colors="primary:#f7b84b,secondary:#f06548" style="width:100px;height:100px"></lord-icon><div class="mt-4 pt-2 fs-15 mx-5"><h4>Are you Sure ?</h4><p class="text-muted mx-4 mb-0">This action will delete the data</p></div></div>',
                        showCancelButton: true,
                        confirmButtonText: "Yes, Delete It!",
                        buttonsStyling: false,
                        showCloseButton: true,
                        customClass: {
                            confirmButton: "btn btn-ghost-danger waves-effect waves-light w-xs me-2 mb-1",
                            cancelButton: "btn btn-danger w-xs mb-1"
                        }
                    }).then((result) => {
                        if (result.isConfirmed) {       
                            console.log("Result : ", result);
                            console.log("post : ", routeMultipleDelete);
                               
                            $.ajax({
                                url: routeMultipleDelete,
                                method: 'POST',
                                headers: {
                                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                },
                                data: {
                                    ids: selectedRows
                                },
                                success: function(response) {
                                    console.log("response delete", response);
                                    
                                    if (response.status == "success") {
                                        Swal.fire({
                                            html: '<div class="mt-3"><lord-icon src="https://cdn.lordicon.com/awmkozsb.json" trigger="loop" colors="primary:#0ab39c,secondary:#212529" style="width:120px;height:120px"></lord-icon><div class="mt-4 pt-2 fs-15"><h4>Well done !</h4><p class="text-muted mx-4 mb-0">' + response.message + '</p></div></div>',
                                            showCancelButton: !0,
                                            showConfirmButton: !1,
                                            cancelButtonText: "Dismiss",
                                            buttonsStyling: !1,
                                            showCloseButton: !0,
                                            customClass: {
                                                cancelButton: "btn btn-primary w-xs mb-1"
                                            }
                                        });
                                        window.LaravelDataTables[idDataTables].ajax.reload();
                                        $('#deleted-data').html('');
                                    } else {
                                        console.log("response error", response);
                                        Swal.fire({
                                            html: '<div class="mt-3"><lord-icon src="https://cdn.lordicon.com/tdrtiskw.json" trigger="loop" colors="primary:#f06548,secondary:#f7b84b" style="width:120px;height:120px"></lord-icon><div class="mt-4 pt-2 fs-15"><h4>Something wrong !</h4><p class="text-muted mx-4 mb-0">'+ response.message + '</p></div></div>',
                                            showCancelButton: !0,
                                            showConfirmButton: !1,
                                            cancelButtonText: "Dismiss",
                                            buttonsStyling: !1,
                                            showCloseButton: !0,
                                            customClass: {
                                                cancelButton: "btn btn-primary w-xs mb-1"
                                            }
                                        });
                                    }
                                },

                                // XMLHttpRequest (xhr)
                                // Provide the request, header, and response from server
                                error: function(xhr, status, error, response) {
                                    console.log("XHR : ", xhr);
                                    console.log("status : ", status);
                                    console.log("error : ", error);
                                    console.log("response : ", response);
                                    Swal.fire({
                                        html: '<div class="mt-3"><lord-icon src="https://cdn.lordicon.com/tdrtiskw.json" trigger="loop" colors="primary:#f06548,secondary:#f7b84b" style="width:120px;height:120px"></lord-icon><div class="mt-4 pt-2 fs-15"><h4>' + xhr.responseJSON.message + ' data !</h4><p class="text-muted mx-4 mb-0">'+ error + '</p></div></div>',
                                        showCancelButton: !0,
                                        showConfirmButton: !1,
                                        cancelButtonText: "Dismiss",
                                        buttonsStyling: !1,
                                        showCloseButton: !0,
                                        customClass: {
                                            cancelButton: "btn btn-primary w-xs mb-1"
                                        }
                                    });
                                }
                            });
                        }
                    });
                });
            }
        // END ____ Multiple Delete Function____


    // ---- END - Global Scope Function ----

</script>