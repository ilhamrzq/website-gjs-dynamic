<x-app-layout>
    <div class="container-fluid">
       <div class="row justify-content-center">
            <div class="col-xxl-10">
                <div class="card">
                   <div class="d-flex me-3 mt-3 justify-content-end">
                        <a href="{{ $action_back }}" type="button" class="btn btn-primary btn-sm btn-label waves-effect waves-light"><i class="ri-arrow-left-line label-icon align-middle fs-16 me-2"></i> {{ __('Back') }} </a>
                    </div>

                    <div class="card-header d-flex">
                        <ul class="flex-grow-1 nav nav-tabs-custom rounded card-header-tabs border-bottom-0" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link {{ session('activeTab','videoMenu') == 'videoMenu' ? 'active' : '' }}" data-bs-toggle="tab" href="#videoMenu" role="tab">
                                    @if (!request()->routeIs('cms.videos.edit') && !request()->routeIs('cms.videos.show'))
                                    {{ __('Video') }}
                                    @endif

                                    @if (request()->routeIs('cms.videos.edit') || request()->routeIs('cms.videos.show'))
                                    {{ __('Edit Video') }}
                                    @endif
                                </a>
                            </li>
                        </ul>
                    </div>

                    <div class="card-body">
                        <div class="tab-content">

                            {{-- Edit Menu --}}
                            <div class="tab-pane nav-link {{ session('activeTab', 'videoMenu') == 'videoMenu' ? 'active' : '' }}" id="videoMenu" role="tabpanel">
                                <div class="live-preview">
                                    @if (isset($record))
                                    <?php $button = 'Save Changes'; ?>
                                    <form action=" {{ $action }} " method="POST" enctype="multipart/form-data">
                                        @csrf
                                    @else
                                    
                                    <?php $button = 'Submit'; ?>
                                    <form action=" {{ $action }} " method="POST" enctype="multipart/form-data">
                                        @csrf
        
                                    @endif
                                        <div class="row">
                                            <div class="row align-items-center">
                                                <div class="col-md-6 col-sm-12">
                                                    <div class="mb-3">
                                                        <x-input-label for="video-title-id" :value="__('Video Title ID')" /><span class="text-danger">*</span>
                                                        <x-text-input type="text" name="video_title_id" :value="old('video_title_id', $record->video_title_id ?? '')" class="form-control" :error="$errors->has('video_title_id')" placeholder="Enter the video title ID" />
                                                        <x-input-error class="mt-2" :messages="$errors->get('video_title_id')" />
                                                    </div>
                                                </div>
                                                
                                                <div class="col-md-6 col-sm-12">
                                                    <div class="mb-3">
                                                        <x-input-label for="video-title-en" :value="__('Video Title EN')" /><span class="text-danger">*</span>
                                                        <x-text-input type="text" name="video_title_en" :value="old('video_title_en', $record->video_title_en ?? '')" class="form-control" :error="$errors->has('video_title_en')" placeholder="Enter the video title EN" />
                                                        <x-input-error class="mt-2" :messages="$errors->get('video_title_en')" />
                                                    </div>
                                                </div>
                                            </div>
                                        
                                            {{-- Single video input --}}
                                            <div class="row align-items-center">
                                                <div class="col-md-6 col-sm-12">
                                                    <div class="mb-3">
                                                        <x-input-label for="video" :value="__('Video File')" />
                                                        <input 
                                                            type="file" 
                                                            name="video" 
                                                            class="form-control"
                                                            accept="video/mp4,video/mov,video/avi,video/wmv"
                                                        />
                                                        {{-- Tampilkan nama file lama jika ada --}}
                                                        @if(isset($record) && $record->file_name)
                                                            <p class="mt-2">Current File: <strong>{{ $record->file_name }}</strong></p>
                                                            @if(isset($record) && $record->file_path)
                                                            <button type="button" 
                                                                class="btn btn-outline-primary btn-icon waves-effect waves-light"
                                                                data-bs-toggle="modal"
                                                                data-bs-target="#videoPreviewModal">
                                                                <i class="ri-play-fill"></i>
                                                            </button>

                                                            <!-- Modal for video preview -->
                                                            <div id="videoPreviewModal" class="modal fade zoomIn" tabindex="-1" aria-labelledby="videoPreviewModal_label" aria-hidden="true">
                                                                <div class="modal-dialog modal-dialog-centered modal-lg">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header">
                                                                            <h5 class="modal-title" id="videoPreviewModal_label">Preview Video</h5>
                                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                        </div>
                                                                        <div class="modal-body text-center">
                                                                            <video controls style="max-width: 100%; height: auto;">
                                                                                <source src="{{ asset($record->file_path) }}" type="video/mp4">
                                                                                Your browser does not support the video tag.
                                                                            </video>
                                                                        </div>
                                                                        <div class="modal-footer">
                                                                            <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        @endif

                                                        @endif
                                                        <x-input-error class="mt-2" :messages="$errors->get('video')" />
                                                    </div>
                                                </div>
                                            </div>


                                            @if ($action)
                                                <div class="col-lg-12 text-end">
                                                    <x-primary-button>{{ __($button) }}</x-primary-button>
                                                </div>
                                            @endif
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
       </div>
    </div>
</x-app-layout>