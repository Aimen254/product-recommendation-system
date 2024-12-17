@extends('layouts.app')
@section('content')
    <div class="nk-content nk-content-lg nk-content-fluid">
        <div class="container-xl wide-lg">
            <div class="nk-content-inner">
                <div class="nk-content-body">

                    @include('layouts.includes.survey_builder_tabs')

                    <div class="nk-block pt-0">
                        <div class="card card-bordered">
                            <div class="card-aside-wrap">
                                <div class="card-aside card-aside-left user-aside toggle-slide toggle-slide-left toggle-break-lg"
                                    data-content="userAside" data-toggle-screen="lg" data-toggle-overlay="true"
                                    style="min-height: 400px">
                                    <div class="card-inner-group">
                                        <div class="card-inner">
                                            <div class="user-card">
                                                <div class="user-info">

                                                    <span class="lead-text">Settings</span>

                                                </div>

                                            </div><!-- .user-card -->
                                        </div><!-- .card-inner -->
                                        <div class="card-inner p-0">
                                            @include('project_settings.side_nav')

                                        </div><!-- .card-inner -->
                                    </div><!-- .card-inner-group -->
                                </div><!-- .card-aside -->
                                <div class="card-inner card-inner-lg" id="questions-form">
                                    <div class="nk-block-head nk-block-head-lg pb-3">
                                        <div class="nk-block-between">
                                            <div class="nk-block-head-content">
                                                <h4 class="nk-block-title">General Settings</h4>
                                                <div class="nk-block-des">
                                                </div>
                                            </div>
                                            <div class="nk-block-head-content align-self-start d-lg-none">
                                                <a href="#" class="toggle btn btn-icon btn-trigger mt-n1"
                                                    data-target="userAside"><em class="icon ni ni-menu-alt-r"></em></a>
                                            </div>
                                        </div>
                                    </div><!-- .nk-block-head -->
                                    <div class="nk-block">
                                        <div class="card ">
                                            <div class="card-inner-group">
                                                <div class="card-inner p-0">
                                                    <form
                                                        action="{{ route('styles.update-general-styles', [currentAccount(), currentProject()]) }}"
                                                        class="gy-3" method="POST" enctype="multipart/form-data"
                                                        data-form="ajax-form">
                                                        @csrf
                                                        <div class="row g-3 align-center">
                                                            <div class="col-lg-3">
                                                                <div class="form-group">
                                                                    <label class="form-label"
                                                                        for="company-name">Background Image</label>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-9">
                                                                <div class="form-group">
                                                                    <div class="form-control-wrap">
                                                                        <div class="profile-picture-upload">
                                                                            <input type="hidden" name="remove_image"
                                                                                class="remove-image" value="0">
                                                                            <img src="@if (getStyles('image')) {{ asset('storage/images/' . getStyles('image')) }} @else {{ asset('images/default.png/') }} @endif"
                                                                                alt=""
                                                                                class="imagePreviewLogo imagePreview mb-3">
                                                                            @if (getStyles('image'))
                                                                            <a class="action-button mode-remove"> <em
                                                                                    class="icon ni ni-trash"></em>Remove</a>
                                                                                    @endif
                                                                            <a class="action-button mode-upload"
                                                                                data-preview=".imagePreviewLogo"
                                                                                data-fileinput=".fileinputlogo"> <em
                                                                                    class="icon ni ni-upload"></em>Upload</a>

                                                                            <input type="file" class="hidden fileinputlogo"
                                                                                name="image" accept="image/*" />
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        {{-- home icon start --}}
                                                        <div class="row g-3 align-center">
                                                            <div class="col-lg-3">
                                                                <div class="form-group">
                                                                    <label class="form-label"
                                                                        for="company-name">Home Icon</label>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-9">
                                                                <div class="form-group">
                                                                    <div class="form-control-wrap">
                                                                        <div class="custom-file">
                                                                            <input type="file" class="custom-file-input" name="home_icon" accept="image/*" />
                                                                            <label class="custom-file-label" for="customFile">Choose
                                                                                file</label>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        {{-- home icon end --}}

                                                        <div class="row g-3 align-center">
                                                            <div class="col-lg-3">
                                                                <div class="form-group">
                                                                    <label class="form-label" for="title">Background
                                                                        Color</label>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-9">
                                                                <div class="form-group">
                                                                    <div class="form-control-wrap">
                                                                        <input type="text" id="general"
                                                                            class="form-control demo"
                                                                            value="{{ getStyles('general_background_color') ? getStyles('general_background_color') : '#E5F4F9' }}"
                                                                            name="general_background_color">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row g-3 align-center">
                                                            <div class="col-lg-3">
                                                                <div class="form-group">
                                                                    <label class="form-label" for="title">Default Advice
                                                                        Page</label>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-9">
                                                                <div class="form-group">
                                                                    <div class="form-control-wrap">
                                                                        <select name="default_advice"
                                                                            class="form-select form-control form-control-lg"
                                                                            data-search="on">
                                                                            @foreach ($advices as $advice)
                                                                                <option
                                                                                    {{ $advice->id == getStyles('default_advice') ? 'selected' : '' }}
                                                                                    value="{{ $advice->id }}">
                                                                                    {{ $advice->title }}</option>
                                                                            @endforeach
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="row g-3">
                                                            <div class="col-lg-9 offset-lg-3">
                                                                <div class="form-group mt-2">
                                                                    <button type="submit" class="btn btn-lg btn-primary"
                                                                        data-button="submit">Update</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div><!-- .card-inner-group -->
                                        </div><!-- .card -->
                                    </div><!-- .nk-block -->
                                </div><!-- .card-inner -->
                            </div><!-- .card-aside-wrap -->
                        </div><!-- .card -->
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    {{-- <script>
        const fontPicker = new FontPicker(
            "AIzaSyDDnuHiUnRQOOuOCpSj4X54SM_0gIruhuU",
            "Open Sans", {
                limit: 10
            }
        );
        $("body").on('click', '.font-button', function() {
            $(".set_font_name").val($(this).html());
        });
    </script> --}}
    <script>
        $(document).ready(function() {
            $('.demo').each(function() {
                $(this).minicolors({
                    control: $(this).attr('data-control') || 'hue',
                    defaultValue: $(this).attr('data-defaultValue') || '',
                    format: $(this).attr('data-format') || 'hex',
                    keywords: $(this).attr('data-keywords') || '',
                    inline: $(this).attr('data-inline') === 'true',
                    letterCase: $(this).attr('data-letterCase') || 'lowercase',
                    opacity: $(this).attr('data-opacity'),
                    position: $(this).attr('data-position') || 'bottom',
                    swatches: $(this).attr('data-swatches') ? $(this).attr('data-swatches').split(
                        '|') : [],
                    change: function(value, opacity) {
                        if (!value) return;
                        if (opacity) value += ', ' + opacity;
                        if (typeof console === 'object') {
                            console.log(value);
                        }
                    },
                    theme: 'bootstrap'
                });
            });
            //   Removing Background Image

            $(".fileinputlogo").change(function() {
                $(".mode-remove").show();
            });
            $(".mode-remove").click(function() {
                $(".imagePreview").attr("src", "{{ asset('images/default.png/') }}");
                $(".remove-image").val(1);
                $(".fileinputlogo").val('');
                $(".mode-remove").hide();
            });
        });
    </script>
@endpush
