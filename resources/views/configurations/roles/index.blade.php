<x-app-layout>
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header align-items-center d-flex">
                        <h4 class="card-title mb-0 flex-grow-1"> {{ __($table_title) }} </h4>
                        <div class="flex-shrink-0">
                            <div class="form-check form-switch form-switch-right form-switch-md">
                                @can('create configurations/role')
                                    <a href="{{ $action }}" type="button" class="btn btn-primary btn-label waves-effect waves-light">
                                        <i class="ri-add-circle-fill label-icon align-middle fs-16 me-2"></i>{{ __($add_button) }}
                                    </a>
                                @endcan
                            </div>
                        </div>
                    </div>
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
        
    </script>
    @endpush
</x-app-layout>