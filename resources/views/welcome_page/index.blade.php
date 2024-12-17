@extends('layouts.app')
@section('content')

    <div class="nk-content nk-content-lg nk-content-fluid">
        <div class="container-xl wide-lg">
            <div class="nk-content-inner">
                <div class="nk-content-body">
                    @include('layouts.includes.survey_builder_tabs')
                    <div class="nk-block pt-0">
                        <div class="card card-bordered">
                            <div class="card-inner card-inner-lg">
                            <div class="nk-data data-list">
                                <div class="nk-block-head">
                                    <div class="nk-block-head-content">
                                        <h4 class="nk-block-title">Welcome Page</h4>
                                        <div class="nk-block-des">
                                        </div>
                                    </div>
                                </div>
                                <form class="gy-3" 
                                    action="{{ route('welcome_page.store', [currentAccount(), currentProject()]) }}"
                                    method="POST" id="welcome-form" enctype="multipart/form-data" data-form="ajax-form"
                                    data-modal="#ajax_model">
                                    @csrf
                                    <div class="row g-3">
                                        <div class="col-lg-3">
                                            <div class="form-group">
                                                <label class="form-label" for="company-name">Logo</label>
                                            </div>
                                        </div>
                                        <div class="col-lg-9">
                                            <div class="form-group">
                                                <div class="form-control-wrap">
                                                    <div class="profile-picture-upload">
                                                        <img src="{{ $page_data ?  ($page_data->image ? asset('storage/images/'.$page_data->image ) : asset("images/default.png/") )  : asset("images/default.png/")}}" alt=""
                                                            class="imagePreviewLogo imagePreview mb-3">
                                                        <a class="action-button mode-upload"
                                                            data-preview=".imagePreviewLogo"
                                                            data-fileinput=".fileinputlogo"> <em class="icon ni ni-upload"></em> Upload</a>
                                                        <input type="file" class="hidden fileinputlogo"
                                                        name="img" accept="image/*" />
                                                    </div>
                                                    
                                                </div>
                                            </div>
                                            
                                        </div>
                                    </div>
                                    <div class="row g-3">
                                        <div class="col-lg-3">
                                            <div class="form-group">
                                                <label class="form-label" for="company-name">Title</label>
                                            </div>
                                        </div>
                                        <div class="col-lg-9">
                                            <div class="form-group">
                                                <div class="form-control-wrap">
                                                    <input type="text" class="form-control" name="title" placeholder="Enter page title heading"
                                                        value="{{ $page_data->title ?? '' }}">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row g-3">
                                        <div class="col-lg-3">
                                            <div class="form-group">
                                                <label class="form-label" for="company-name">Description
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-lg-9">
                                            <div class="form-group">
                                                <div class="form-control-wrap">
                                                    <textarea class="form-control" name="description"
                                                        aria-label="With textarea"
                                                        spellcheck="false">{{ $page_data->description ?? '' }}</textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row g-3 align-center">
                                        <div class="col-lg-3">
                                            <div class="form-group">
                                                <label class="form-label" for="company-name">Button
                                                    Text
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-lg-9">
                                            <div class="form-group">
                                                <div class="form-control-wrap">
                                                    <input type="text" value="{{ $page_data->button_text ?? '' }}"
                                                        class="form-control" name="button_text"
                                                        placeholder="Enter Button Text">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row g-3 align-center">
                                        <div class="col-lg-3">
                                            
                                        </div>
                                        <div class="col-lg-9">
                                            <button class="btn btn-primary btn-lg">Update</button>
                                        </div>
                                    </div>
                                    
                                    
                                </form>
                            </div><!-- .nk-data -->
                            </div>
                        </div><!-- .card -->
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            $('.active-tab').addClass('active');
        });
    </script>
@endpush
