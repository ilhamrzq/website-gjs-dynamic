<x-app-layout>
    {{-- <p> {{ $data }} </p> --}}
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0">Remix</h4>
                     <button type="button" class="btn btn-primary btn-sm" id="sa-error">Click me</button>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item d-flex align-items-center">
                                <i class="ri-arrow-left-line me-2"></i>
                                <a href="{{ route('configurations.menu.create') }}">{{ __('Back') }}</a>
                            </li>
                            {{-- <li class="breadcrumb-item active">Remix</li> --}}
                        </ol>
                    </div>

                </div>
            </div>
        </div>
        <!-- end page title -->

        <div class="row">

        </div><!-- end row -->

        <div class="row">
            <div class="col-12" id="icons"></div> <!-- end col-->
        </div><!-- end row -->
    </div>

    @push('custom-script')
        <script src="{{ asset('/assets/js/pages/remix-icons-listing.js') }}"></script>
    @endpush
</x-app-layout>