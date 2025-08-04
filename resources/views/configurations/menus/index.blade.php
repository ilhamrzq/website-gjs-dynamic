<x-app-layout>
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header align-items-center d-md-flex">
                        <h4 class="card-title mb-md-0 mb-sm-3 flex-grow-1 "> {{ __($table_title) }} </h4>
                    
                        <div class="flex-shrink-0">
                            @can('create configurations/menu')
                                <a href="{{ $action }}" type="button" class="btn btn-primary btn-label waves-effect waves-light me-2">
                                    <i class="ri-add-circle-fill label-icon align-middle fs-16 me-2"></i>{{ __($add_button) }}
                                </a>
                            @endcan
                            
                            @can('sort configurations/menu')
                                <a href="{{ route('configurations.menu.sort') }}" role="button" class="btn btn-primary btn-label waves-effect waves-light sort">
                                    <i class="ri-filter-3-fill label-icon align-middle fs-16 me-2"></i>{{ __('Sort Menu') }}
                                </a>
                            @endcan
                        </div>
                    </div>

                    @can('delete configurations/menu')
                        <div class="row">
                            <div class="mt-3 d-flex justify-content-center" id="deleted-data">
                                {{-- The delete button will appear here --}}
                            </div>
                        </div>
                    @endcan

                    <div class="card-body">
                        {{ $dataTable->table([
                            'class' => 'table nowrap dt-responsive align-middle table-hover table-bordered',
                            'style' => 'width:100%'
                            ]) }}
                    </div>
                </div>
            </div>
        </div>
    </div>


    @push('custom-script')
    {{ $dataTable->scripts(attributes: ['type' => 'module']) }}
    <script>
        $(document).ready(function () {

            // Sort Menu
            $('.sort').on('click', function(e) {
                e.preventDefault()
                var url = this.href
                var csrfToken = $('meta[name="csrf-token"]').attr('content')
    
                $.ajax({
                    url: url,
                    type: 'PUT',
                    headers: {
                        'X-CSRF-TOKEN': csrfToken
                    },
                    success: function(response) {
                        window.location.reload();
                    },
                    error: function(error) {
                        console.log(error);
                    }
                })
            });

            // Call multiple delete
            multipleDelete("{{ route('configurations.menu.multiple.destroy') }}", 'menus-table');
        });


    </script>
    @endpush
</x-app-layout>