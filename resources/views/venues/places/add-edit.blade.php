<x-app-layout>
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-xxl-10">
                <div class="card">
                    <div class="d-flex me-3 mt-3 justify-content-end">
                        <a href="{{ $action_back }}" type="button"
                            class="btn btn-primary btn-sm btn-label waves-effect waves-light"><i
                                class="ri-arrow-left-line label-icon align-middle fs-16 me-2"></i> {{ __('Back') }}
                        </a>
                    </div>

                    <div class="card-header d-flex">
                        <ul class="flex-grow-1 nav nav-tabs-custom rounded card-header-tabs border-bottom-0"
                            role="tablist">
                            <li class="nav-item">
                                <a class="nav-link {{ session('activeTab', 'venueData') == 'venueData' ? 'active' : '' }}"
                                    data-bs-toggle="tab" href="#venueData" role="tab">
                                    @if (!request()->routeIs('venues.places.edit') && !request()->routeIs('venues.places.show'))
                                        {{ __('Venue') }}
                                    @endif

                                    @if (request()->routeIs('venues.places.edit') || request()->routeIs('venues.places.show'))
                                        {{ __('Edit Venue') }}
                                    @endif
                                </a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link {{ session('activeTab') == 'venueImage' ? 'active' : '' }}"
                                    data-bs-toggle="tab" href="#venueImage" role="tab"
                                    @if (!request()->routeIs('venues.places.edit') && !request()->routeIs('venues.places.show')) style="display: none;" @endif>
                                    {{ __('Images of the ' . Str::title($record->venue_name ?? '')) }}
                                </a>
                            </li>
                        </ul>
                    </div>

                    <div class="card-body">
                        <div class="tab-content">

                            {{-- Edit Venue --}}
                            <div class="tab-pane nav-link {{ session('activeTab', 'venueData') == 'venueData' ? 'active' : '' }}"
                                id="venueData" role="tabpanel">
                                <div class="live-preview">

                                    @if (isset($record))
                                        <?php $button = 'Save Changes'; ?>
                                        <form action=" {{ $action }} " method="POST">
                                            @csrf
                                        @else
                                            <?php $button = 'Submit'; ?>
                                            <form action=" {{ $action }} " method="POST">
                                                @csrf
                                    @endif
                                    <div class="row">
                                        <div class="col-md-6 col-sm-12">
                                            <div class="mb-3">
                                                <x-input-label for="venue-name" :value="__('Venue Name')" /><span
                                                    class="text-danger">*</span>
                                                <x-text-input type="text" name="venue_name" :value="old('venue_name', $record->venue_name ?? '')"
                                                    class="form-control" :error="$errors->has('venue_name')"
                                                    placeholder="Enter the venue name" />
                                                <x-input-error class="mt-2" :messages="$errors->get('venue_name')" />
                                            </div>
                                        </div>

                                        <div class="col-md-6 col-sm-12">
                                            <div class="mb-3">
                                                <x-input-label for="venue-address" :value="__('Venue Address')" /><span
                                                    class="text-danger">*</span>
                                                <x-text-input type="text" name="venue_address" :value="old('venue_address', $record->venue_address ?? '')"
                                                    class="form-control" :error="$errors->has('venue_address')"
                                                    placeholder="Enter the venue address" />
                                                <x-input-error class="mt-2" :messages="$errors->get('venue_address')" />
                                            </div>
                                        </div>

                                        <div class="col-md-6 col-sm-12">
                                            <div class="mb-3">
                                                <x-input-label for="venue_price" :value="__('Membership Price')" />
                                                <span class="text-danger">*</span>
                                                <div class="input-group">
                                                    <span class="input-group-text">Rp</span>
                                                    <x-text-input type="text" id="venue_price" name="venue_price"
                                                        :value="old('venue_price', $record->venue_price ?? '')" data-format="currency" class="form-control"
                                                        :error="$errors->has('venue_price')" placeholder="10000" />
                                                </div>
                                                <x-input-error class="mt-2" :messages="$errors->get('venue_price')" />
                                            </div>
                                        </div>

                                        <div class="col-md-6 col-sm-12">
                                            <div class="mb-3">
                                                <x-input-label for="venue-url" :value="__('Venue Maps URL')" /><span
                                                    class="text-danger">*</span>
                                                <x-text-input type="text" name="venue_url" :value="old('venue_url', $record->venue_url ?? '')"
                                                    class="form-control" :error="$errors->has('venue_url')"
                                                    placeholder="Enter the venue url" />
                                                <x-input-error class="mt-2" :messages="$errors->get('venue_url')" />
                                            </div>
                                        </div>

                                        <div class="col-md-6 col-sm-12">
                                            <div class="mb-3">
                                                <x-input-label for="venue-opening-time" :value="__('Venue Opening Time')" /><span
                                                    class="text-danger">*</span>
                                                <x-text-input type="time" name="venue_opening_time"
                                                    :value="old(
                                                        'venue_opening_time',
                                                        $record->venue_opening_time ?? '',
                                                    )" class="form-control" :error="$errors->has('venue_opening_time')"
                                                    placeholder="Enter the venue opening_time" />
                                                <x-input-error class="mt-2" :messages="$errors->get('venue_opening_time')" />
                                            </div>
                                        </div>

                                        <div class="col-md-6 col-sm-12">
                                            <div class="mb-3">
                                                <x-input-label for="venue-closing-time" :value="__('Venue Closing Time')" /><span
                                                    class="text-danger">*</span>
                                                <x-text-input type="time" name="venue_closing_time"
                                                    :value="old(
                                                        'venue_closing_time',
                                                        $record->venue_closing_time ?? '',
                                                    )" class="form-control" :error="$errors->has('venue_closing_time')"
                                                    placeholder="Enter the venue closing_time" />
                                                <x-input-error class="mt-2" :messages="$errors->get('venue_closing_time')" />
                                            </div>
                                        </div>

                                        @if ($action)
                                            <div class="col-lg-12 text-end">
                                                <x-primary-button loading-text="Saving..."> {{ __($button) }}
                                                </x-primary-button>
                                            </div>
                                        @endif
                                        <!--end col-->
                                    </div>
                                    <!--end row-->
                                    </form>
                                </div>
                            </div>

                            {{-- Edit Venue Images --}}
                            <div class="tab-pane nav-link {{ session('activeTab') == 'venueImage' ? 'active' : '' }}"
                                id="venueImage" role="tabpanel">

                                @if ($action)
                                    <div class="row">

                                        <div class="col-lg-12">
                                            <div class="card-body">
                                                <p class="text-muted">Choose one or more images, than drag and drop them
                                                    into the box. <br> <strong class="text-primary">A Maximum of 10
                                                        images can be uploaded at once</strong></p>

                                                <div class="dropzone" id="image-dropzone">
                                                    <div class="fallback">
                                                        <input name="file" type="file" multiple="multiple">
                                                    </div>
                                                    <div class="dz-message needsclick">
                                                        <div class="mb-3">
                                                            <i class="display-4 text-muted ri-upload-cloud-2-fill"></i>
                                                        </div>

                                                        <h4>Drop files here or click to upload.</h4>
                                                    </div>
                                                </div>

                                                <!-- start dropzon-preview -->
                                                <ul class="list-unstyled mb-0" id="dropzone-preview">
                                                    <li class="mt-2" id="dropzone-preview-list">

                                                        <!-- This is used as the file preview template -->
                                                        <div class="border rounded">
                                                            <div class="d-flex p-2">
                                                                <div class="flex-shrink-0 me-3">
                                                                    <div class="avatar-sm bg-light rounded">
                                                                        <img data-dz-thumbnail
                                                                            class="img-fluid rounded d-block"
                                                                            alt="Dropzone-Image" />
                                                                    </div>
                                                                </div>
                                                                <div class="flex-grow-1">
                                                                    <div class="pt-1">
                                                                        <h5 class="fs-14 mb-1" data-dz-name>&nbsp;</h5>
                                                                        <p class="fs-13 text-muted mb-0" data-dz-size>
                                                                        </p>
                                                                        <strong class="error text-danger"
                                                                            data-dz-errormessage></strong>

                                                                        <div class="progress animated-progress custom-progress mt-3"
                                                                            aria-valuemin="0" aria-valuemax="100"
                                                                            aria-valuenow="0">
                                                                            <div class="progress-bar bg-success"
                                                                                style="width: 0%"
                                                                                data-dz-uploadprogress></div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="flex-shrink-0 ms-3">
                                                                    {{-- <button class="btn btn-sm btn-info upload">Upload</button> --}}
                                                                    <button data-dz-remove
                                                                        class="btn btn-sm btn-soft-danger btn-icon waves-effect waves-light"><i
                                                                            class=" ri-close-fill"></i></button>
                                                                </div>
                                                            </div>
                                                        </div>

                                                    </li>
                                                </ul>
                                                <!-- end dropzon-preview -->

                                                <div class="row mt-3 d-flex justify-content-between">
                                                    <div class="col-sm-12 col-md-2">
                                                        <!-- Button for manual upload -->
                                                        <button type="submit" id="uploadAll" style="display: none;"
                                                            class="btn w-100 btn-primary btn-label waves-effect waves-light mt-3">
                                                            <i
                                                                class="ri-upload-cloud-fill label-icon align-middle fs-16 me-2"></i>
                                                            Upload
                                                        </button>
                                                    </div>

                                                    <div class="col-sm-12 col-md-2">
                                                        <button type="submit" id="cancelUpload"
                                                            class="btn w-100 btn-soft-danger mt-3"
                                                            style="display: none;">Cancel Upload</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                @endif

                                {{-- Image Table --}}
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="card-header">
                                            <h5 class="card-title mb-0">{{ $venue_name ?? '' }} Images</h5>
                                        </div>
                                        <div class="card-body">
                                            <table id="venue-images"
                                                class="table table-bordered dt-responsive table-striped align-middle"
                                                style="width: 100%">
                                                <thead>
                                                    <tr>
                                                        <th class="text-center">No</th>
                                                        <th class="text-center">Set Default</th>
                                                        <th>Name</th>
                                                        <th>Size</th>
                                                        <th>Updated At</th>
                                                        <th class="text-center">Updated By</th>
                                                        <th class="text-center">Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($venue_images as $image)
                                                        <tr>
                                                            <td class="text-center"> {{ $loop->iteration }} </td>
                                                            <td>
                                                                <div
                                                                    class="form-check form-switch text-center form-switch-secondary">
                                                                    <input class="form-check-input switch-default"
                                                                        type="checkbox" role="switch"
                                                                        id="{{ $image->file_name . $image->id }}"
                                                                        @if ($image->is_default == 1) checked @endif
                                                                        data-id={{ $image->id }}>
                                                                </div>
                                                            </td>
                                                            <td> {{ substr($image->file_name, strpos($image->file_name, '-') + 1) }}
                                                            </td>
                                                            <td> {{ number_format($image->file_size / 1024, 2) }} KB
                                                            </td>
                                                            <td> {{ \Carbon\Carbon::parse($image->updated_at)->translatedFormat('j F Y, H:i:s') }}
                                                            </td>
                                                            <td class="text-center"> {{ $image->user->name ?? '' }}
                                                            </td>
                                                            <td class="text-center">
                                                                <div class="dropdown d-inline-block">
                                                                    <button
                                                                        class="btn btn-soft-secondary btn-sm dropdown"
                                                                        type="button" data-bs-toggle="dropdown"
                                                                        aria-expanded="false">
                                                                        <i class="ri-more-fill align-middle"></i>
                                                                    </button>
                                                                    <ul class="dropdown-menu dropdown-menu-end">
                                                                        <li>
                                                                            <a role="button" data-bs-toggle="modal"
                                                                                data-bs-target="#zoomInModal{{ $image->id }}"
                                                                                class="dropdown-item"><i
                                                                                    class="ri-eye-fill align-bottom me-2 text-muted"></i>
                                                                                View</a>
                                                                        </li>
                                                                        <form
                                                                            action="{{ route('venues.places.delete.image', $image->id) }}"
                                                                            method="post"
                                                                            id="deleteForm{{ $image->id }}">
                                                                            @csrf
                                                                            <li class="dropdown-divider"></li>
                                                                            <li>
                                                                                <a role="button" type="submit"
                                                                                    class="dropdown-item remove-item-btn"
                                                                                    onclick="confirmDelete(event, '{{ $image->id }}')">
                                                                                    <i
                                                                                        class="ri-delete-bin-fill align-bottom me-2 text-muted"></i>Delete
                                                                                </a>
                                                                            </li>
                                                                        </form>
                                                                    </ul>
                                                                </div>
                                                            </td>
                                                        </tr>


                                                        <div id="zoomInModal{{ $image->id }}"
                                                            class="modal fade zoomIn" tabindex="-1"
                                                            aria-labelledby="zoomInModalLabel" aria-hidden="true"
                                                            style="display: none;">
                                                            <div class="modal-dialog modal-dialog-centered">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title" id="zoomInModalLabel">
                                                                            {{ $image->file_name }} </h5>
                                                                        <button type="button" class="btn-close"
                                                                            data-bs-dismiss="modal"
                                                                            aria-label="Close"></button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <img src="{{ asset($image->file_path) }}"
                                                                            class="img-fluid" alt="Responsive image">
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-light"
                                                                            data-bs-dismiss="modal">Close</button>
                                                                    </div>

                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @push('custom-script')
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                document.querySelectorAll('input[name="venue_price"]').forEach(function(input) {
                    input.addEventListener('keydown', function(e) {
                        // Izinkan tombol navigasi, backspace, delete, tab, enter
                        if (
                            e.key === "Backspace" ||
                            e.key === "Delete" ||
                            e.key === "Tab" ||
                            e.key === "Enter" ||
                            e.key === "ArrowLeft" ||
                            e.key === "ArrowRight" ||
                            e.key === "Home" ||
                            e.key === "End"
                        ) {
                            return;
                        }

                        // Izinkan Ctrl+A, Ctrl+C, Ctrl+V, Ctrl+X
                        if ((e.ctrlKey || e.metaKey) && ["a", "c", "v", "x"].includes(e.key
                                .toLowerCase())) {
                            return;
                        }

                        // Jika bukan digit 0-9, prevent
                        if (!/^\d$/.test(e.key)) {
                            e.preventDefault();
                        }
                    });
                });
            });
        </script>

        <script>
            $(document).ready(function() {
                // initiate datatable
                $("#venue-images").DataTable({
                    response: true
                });

                $('.switch-default').on('change', function() {
                    var imgId = $(this).data('id');
                    var isDefault = $(this).is(':checked') ? 1 : 0;
                    var updateUrl = "{{ route('venues.places.update.default.image', ':venueImageId') }}";
                    var url = updateUrl.replace(':venueImageId', imgId);

                    console.log("Image ID : ", imgId);
                    console.log("is default : ", isDefault);
                    console.log("URL : ", url);

                    // AJAX Request
                    $.ajax({
                        url: url,
                        method: 'POST',
                        dataType: 'JSON',
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        data: {
                            is_default: isDefault,
                            encrypted: encrypted
                        },
                        success: function(data) {
                            console.log("data : ", data);

                            if (data.success) {
                                Swal.fire({
                                    html: '<div class="mt-3"><lord-icon src="https://cdn.lordicon.com/awmkozsb.json" trigger="loop" colors="primary:#0ab39c,secondary:#212529" style="width:120px;height:120px"></lord-icon><div class="mt-4 pt-2 fs-15"><h4>Well done !</h4><p class="text-muted mx-4 mb-0">' +
                                        data.message + '</p></div></div>',
                                    showCancelButton: false,
                                    showConfirmButton: true,
                                    confirmButtonText: "OK",
                                    buttonsStyling: false,
                                    showCloseButton: true,
                                    timer: 1500,
                                    timerProgressBar: true,
                                    customClass: {
                                        confirmButton: "btn btn-primary w-xs mb-1",
                                    }
                                }).then((result) => {
                                    setTimeout(function() {
                                        location.reload();
                                    }, 500);
                                });
                            } else {
                                Swal.fire({
                                    html: '<div class="mt-3"><lord-icon src="https://cdn.lordicon.com/tdrtiskw.json" trigger="loop" colors="primary:#f06548,secondary:#f7b84b" style="width:120px;height:120px"></lord-icon><div class="mt-4 pt-2 fs-15"><h4>Oops...! Something went Wrong !</h4><p class="text-muted mx-4 mb-0">' +
                                        data.message + '</p></div></div>',
                                    showCancelButton: false,
                                    showConfirmButton: true,
                                    confirmButtonText: "OK",
                                    buttonsStyling: false,
                                    showCloseButton: true,
                                    customClass: {
                                        confirmButton: "btn btn-primary w-xs mb-1",
                                    }
                                });
                            }
                        },
                        error: function(xhr, status, error) {
                            console.log("XHR : ", xhr);
                            console.log("status : ", status);
                            console.log("error : ", error);

                            Swal.fire({
                                html: '<div class="mt-3"><lord-icon src="https://cdn.lordicon.com/tdrtiskw.json" trigger="loop" colors="primary:#f06548,secondary:#f7b84b" style="width:120px;height:120px"></lord-icon><div class="mt-4 pt-2 fs-15"><h4>Oops...! Something went Wrong !</h4><p class="text-muted mx-4 mb-0">An error occured while updating image</p></div></div>',
                                showCancelButton: false,
                                showConfirmButton: false,
                                confirmButtonText: "OK",
                                buttonsStyling: false,
                                showCloseButton: true,
                                customClass: {
                                    confirmButton: "btn btn-primary w-xs mb-1",
                                }
                            });
                        }
                    });
                });
            })
        </script>

        <script>
            var path = window.location.pathname;
            var segments = path.split('/');
            var encrypted = segments[3];

            Dropzone.autoDiscover = false; // Disable auto-discover untuk konfigurasi manual

            // Mendapatkan template HTML dan menghapusnya dari dokumen
            var previewNode = document.querySelector("#dropzone-preview-list");
            previewNode.id = ""; // Hapus ID dari template
            var previewTemplate = previewNode.parentNode.innerHTML;
            previewNode.parentNode.removeChild(previewNode); // Hapus elemen template dari DOM

            // Inisialisasi Dropzone
            var myDropzone = new Dropzone("#image-dropzone", {
                url: "{{ route('venues.places.upload.images') }}", // URL untuk upload
                params: {
                    encrypted: encrypted
                },
                thumbnailWidth: 80,
                thumbnailHeight: 80,
                parallelUploads: 10, // Jumlah file yg di-upload secara bersamaan dalam 1 request yang sama
                uploadMultiple: true,
                previewTemplate: previewTemplate, // Template untuk preview
                autoProcessQueue: false, // auto upload
                previewsContainer: "#dropzone-preview", // Container untuk preview
                clickable: ".dz-message", // Elemen yang bisa diklik untuk memilih file
                maxFilesize: 1,
                maxFiles: 10,
                acceptedFiles: "image/png, 'image/jpg, image/jpeg",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
            });

            console.log("property dropzone : ", myDropzone);


            // ---- Start: Upload manual ----
            // Ketika file ditambahkan ke Dropzone
            myDropzone.on("addedfile", function(file) {
                // Reset status file agar dapat di-upload ulang
                file.status = Dropzone.ADDED;

                // Update gambar thumbnail ketika file ditambahkan
                file.previewElement.querySelector("img").src = file.dataURL;

                // show button when file has been successfully added
                document.querySelector("#uploadAll").style.display = "block";
                document.querySelector("#cancelUpload").style.display = "block";
                document.querySelector("#uploadAll").removeAttribute("disabled");

                // // Handle tombol upload di setiap gambar untuk memulai upload file secara manual kalo autoQueue: false tidak masuk ke antrian secara otomatis
                // file.previewElement.querySelector(".start").onclick = function () {
                //     myDropzone.enqueueFile(file);
                // };

                checkForErrors();
            });

            // button for manual upload all files
            document.getElementById("uploadAll").addEventListener('click', function(e) {
                e.preventDefault();

                Swal.fire({
                    html: '<div class="mt-3"><lord-icon src="https://cdn.lordicon.com/rszslpey.json" trigger="loop" colors="primary:#f7b84b,secondary:#f06548" style="width:100px;height:100px"></lord-icon><div class="mt-4 pt-2 fs-15 mx-5"><h4>Do you want to upload all of these files ?</h4></div></div>',
                    showCancelButton: !0,
                    confirmButtonText: "Yes, upload please!",
                    buttonsStyling: !1,
                    showCloseButton: !0,
                    customClass: {
                        confirmButton: "btn btn-primary waves-effect waves-light w-xs me-2 mb-1",
                        cancelButton: "btn btn-ghost-danger w-xs mb-1"
                    }
                }).then((result) => {
                    if (result.isConfirmed) {
                        myDropzone.processQueue();
                    }
                });
            });

            myDropzone.on("sendingmultiple", function(file, xhr, formData) {
                // And disable the upload button
                document.querySelector("#uploadAll").setAttribute("disabled", "");
                formData.append('encrypted', encrypted);
            });
            // ---- End: Upload manual ----


            // Update progress bar saat upload berlangsung
            myDropzone.on("uploadprogress", function(file, progress) {
                var progressBar = file.previewElement.querySelector(".progress-bar");
                if (progressBar) {
                    progressBar.style.width = progress + "%"; // Update lebar progress bar
                }
            });

            // Hide progress bar when upload is complete
            myDropzone.on("queuecomplete", function(progress) {
                var progressBar = document.querySelectorAll(".custom-progress");
                progressBar.forEach((progressBar) => {
                    progressBar.style.display = "none";
                });

                checkForErrors();
            });

            // Handle the event when images have been successfully uploaded to the server
            myDropzone.on("successmultiple", function(files, response) {
                files.forEach(function(file) {
                    myDropzone.removeFile(file);
                });

                document.getElementById("uploadAll").style.display = "none";
                document.getElementById("cancelUpload").style.display = "none";

                Swal.fire({
                    html: '<div class="mt-3"><lord-icon src="https://cdn.lordicon.com/awmkozsb.json" trigger="loop" colors="primary:#0ab39c,secondary:#212529" style="width:120px;height:120px"></lord-icon><div class="mt-4 pt-2 fs-15"><h4>Well done !</h4><p class="text-muted mx-4 mb-0">Your file was uploaded successfully.</p></div></div>',
                    showCancelButton: false,
                    showConfirmButton: true,
                    showCloseButton: true,
                    confirmButtonText: "OK",
                    buttonsStyling: false,
                    timer: 2000,
                    timerProgressBar: true,
                    customClass: {
                        confirmButton: "btn btn-primary w-xs mb-1",
                    }
                }).then((result) => {
                    setTimeout(() => {
                        location.reload();
                    }, 500);
                });

            });

            // check if there is any file in the box
            myDropzone.on("removedfile", function(file) {
                if (myDropzone.files.length === 0) {
                    document.querySelector("#uploadAll").style.display = "none";
                    document.querySelector("#cancelUpload").style.display = "none";
                }

                checkForErrors();
            });

            // Handle error untuk setiap file yang gagal di-upload
            // myDropzone.on("error", function(file, errorMessage) {
            //     // Jika error berupa object, tampilkan semua pesan error
            //     if (typeof errorMessage === 'object' && errorMessage.message) {
            //         errorMessage = Object.values(errorMessage.errors).flat().join(", ");
            //     }

            //     // Tampilkan error pada elemen yang relevan
            //     file.previewElement.querySelector("[data-dz-errormessage]").textContent = errorMessage;
            //     document.querySelector("#uploadAll").style.display = "none";

            //     console.log("Error Message: ", errorMessage);
            // });


            // Handle errormultiple
            myDropzone.on("errormultiple", function(files, errorMessage) {
                files.forEach(function(file) {
                    if (typeof errorMessage === 'object' && errorMessage.message) {
                        errorMessage = object.values(errorMessage.errors).flat().join(", ");
                    }

                    file.previewElement.querySelector("[data-dz-errormessage]").textContent = errorMessage;
                    checkForErrors();
                });
            });

            function checkForErrors() {
                var errorElements = document.querySelectorAll(".dz-error");

                if (errorElements.length === 0 && myDropzone.files.length > 0) {
                    // Jika tidak ada elemen dengan class 'dz-error' dan ada file valid, tampilkan tombol uploadAll
                    document.querySelector("#uploadAll").style.display = "block";
                } else {
                    // Jika ada elemen dengan class 'dz-error', sembunyikan tombol uploadAll
                    document.querySelector("#uploadAll").style.display = "none";
                }
            }

            // handle untuk cancel semua file
            document.querySelector("#cancelUpload").onclick = function() {
                myDropzone.removeAllFiles(true);
                document.querySelector("#uploadAll").style.display = "none";
                document.querySelector("#cancelUpload").style.display = "none";
            };
        </script>
    @endpush
</x-app-layout>
