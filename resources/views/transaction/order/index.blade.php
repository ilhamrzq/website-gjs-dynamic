<x-app-layout>
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header align-items-center d-md-flex">
                        <h4 class="card-title mb-md-0 mb-sm-3 flex-grow-1 "> {{ __($table_title) }} </h4>
                    
                        <div class="flex-shrink-0">
                            @can('create transaction/orders')
                                <a href="{{ $action }}" type="button" class="btn btn-primary btn-label waves-effect waves-light me-2">
                                    <i class="ri-add-circle-fill label-icon align-middle fs-16 me-2"></i>{{ __($add_button) }}
                                </a>
                            @endcan
                                <a href="{{ route('transaction.order.pending.inovice') }}" type="button" class="btn btn-success btn-label waves-effect waves-light me-2">
                                    <i class="ri-add-circle-fill label-icon align-middle fs-16 me-2"></i> Prainvoice
                                </a>

                                <a href="{{ route('transaction.order.success.final') }}" type="button" class="btn btn-info btn-label waves-effect waves-light me-2">
                                    <i class="ri-add-circle-fill label-icon align-middle fs-16 me-2"></i> Final Invoice
                                </a>
                        </div>
                    </div>

                    @can('delete transaction/orders')
                        <div class="row">
                            <div class="mt-3 d-flex justify-content-center" id="deleted-data">
                                {{-- The delete button will appear here --}}
                            </div>
                        </div>
                    @endcan

                    {{-- <div class="card-body">
                        {{ $dataTable->table([
                            'class' => 'table nowrap dt-responsive align-middle table-hover table-bordered',
                            'style' => 'width:100%'
                            ]) }}
                    </div> --}}
                </div>
            </div>
        </div>
    </div>


    @push('custom-script')
    {{-- {{ $dataTable->scripts(attributes: ['type' => 'module']) }}
    <script>
        $(document).ready(function () {

            // Call multiple delete
            multipleDelete("{{ route('master.area.multiple.destroy') }}", 'area-table');
        });


    </script> --}}
    @endpush
</x-app-layout>