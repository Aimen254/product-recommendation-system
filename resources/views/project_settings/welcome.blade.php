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
                                                <h4 class="nk-block-title">Welcome Settings</h4>
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
                                                                    <label class="form-label" for="title">Title
                                                                        Color</label>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-9">
                                                                <div class="form-group">
                                                                    <div class="form-control-wrap">
                                                                        <input type="text" class="form-control demo"
                                                                            name="welcome_page_title_color"
                                                                            value="{{(getStyles('welcome_page_title_color')) ?   getStyles('welcome_page_title_color')  : '#002B5C' }}">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row g-3 align-center">
                                                            <div class="col-lg-3">
                                                                <div class="form-group">
                                                                    <label class="form-label" for="title">Description
                                                                        Color</label>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-9">
                                                                <div class="form-group">
                                                                    <div class="form-control-wrap">
                                                                        <input type="text" class="form-control demo"
                                                                            name="welcome_page_description_color"
                                                                            value="{{ (getStyles('welcome_page_description_color')) ? getStyles('welcome_page_description_color') : '#002B5C' }}">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row g-3 align-center">
                                                            <div class="col-lg-3">
                                                                <div class="form-group">
                                                                    <label class="form-label" for="title">
                                                                        Title Font Size</label>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-9">
                                                                <div class="form-group">
                                                                    <div class="form-control-wrap">
                                                                        <input type="text" class="form-control"
                                                                            name="title_font_size"
                                                                            value="@if (getStyles('title_font_size')) {{ getStyles('title_font_size') }}@else{{ 9 }} @endif">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row g-3 align-center">
                                                            <div class="col-lg-3">
                                                                <div class="form-group">
                                                                    <label class="form-label" for="title">
                                                                        Description Font Size</label>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-9">
                                                                <div class="form-group">
                                                                    <div class="form-control-wrap">
                                                                        <input type="text" class="form-control"
                                                                            name="description_font_size"
                                                                            value="@if (getStyles('description_font_size')) {{ getStyles('description_font_size') }}@else{{ 9 }} @endif">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row g-3 align-center">
                                                            <div class="col-lg-3">
                                                                <div class="form-group">
                                                                    <label class="form-label" for="title">Button
                                                                        Background Color</label>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-9">
                                                                <div class="form-group">
                                                                    <div class="form-control-wrap">
                                                                        <input type="text" class="form-control demo"
                                                                            name="welcome_page_button_background_color"
                                                                            value="{{ (getStyles('welcome_page_button_background_color')) ? getStyles('welcome_page_button_background_color') : '#D60C8C' }}">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row g-3 align-center">
                                                            <div class="col-lg-3">
                                                                <div class="form-group">
                                                                    <label class="form-label" for="title">Button Text
                                                                        Color</label>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-9">
                                                                <div class="form-group">
                                                                    <div class="form-control-wrap">
                                                                        <input type="text" class="form-control demo"
                                                                            name="welcome_page_button_text_color"
                                                                            value="{{(getStyles('welcome_page_button_text_color')) ? getStyles('welcome_page_button_text_color') : '#ffffff' }}">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="row g-3 align-center">
                                                            <div class="col-lg-3">
                                                                <div class="form-group">
                                                                    <label class="form-label" for="title">Title Font
                                                                        Family</label>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-9">
                                                                <div class="form-group">
                                                                    <div class="form-control-wrap">
                                                                        <select name="welcome_title_font_family"
                                                                            class="form-select form-control form-control-lg"
                                                                            data-search="on">
                                                                            <option></option>
                                                                            @foreach ($fonts as $font)
                                                                                <option
                                                                                    {{ $font->google_fonts == getStyles('welcome_title_font_family') ? 'selected' : '' }}
                                                                                    value="{{ $font->google_fonts }}">
                                                                                    {{ $font->google_fonts }}</option>
                                                                            @endforeach
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="row g-3 align-center">
                                                            <div class="col-lg-3">
                                                                <div class="form-group">
                                                                    <label class="form-label" for="title">Description
                                                                        Font
                                                                        Family</label>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-9">
                                                                <div class="form-group">
                                                                    <div class="form-control-wrap">
                                                                        <select name="welcome_description_font_family"
                                                                            class="form-select form-control form-control-lg"
                                                                            data-search="on">
                                                                            <option></option>
                                                                            @foreach ($fonts as $font)
                                                                                <option
                                                                                    {{ $font->google_fonts == getStyles('welcome_description_font_family') ? 'selected' : '' }}
                                                                                    value="{{ $font->google_fonts }}">
                                                                                    {{ $font->google_fonts }}</option>
                                                                            @endforeach
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="row g-3 align-center">
                                                            <div class="col-lg-3">
                                                                <div class="form-group">
                                                                    <label class="form-label" for="title">Title Font
                                                                        Weight</label>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-9">
                                                                <div class="form-group">
                                                                    <div class="form-control-wrap">
                                                                        <select name="welcome_title_font_weight"
                                                                            class="form-select form-control form-control-lg"
                                                                            data-search="on">
                                                                            <option></option>
                                                                            @foreach (Config::get('font_weight') as $fontWeight)
                                                                                <option
                                                                                    {{ $fontWeight == getStyles('welcome_title_font_weight') ? 'selected' : '' }}
                                                                                    value="{{ $fontWeight }}">
                                                                                    {{ $fontWeight }}</option>
                                                                            @endforeach
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row g-3 align-center">
                                                            <div class="col-lg-3">
                                                                <div class="form-group">
                                                                    <label class="form-label" for="title">Description
                                                                        Font
                                                                        Weight</label>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-9">
                                                                <div class="form-group">
                                                                    <div class="form-control-wrap">
                                                                        <select name="welcome_description_font_weight"
                                                                            class="form-select form-control form-control-lg"
                                                                            data-search="on">
                                                                            <option></option>
                                                                            @foreach (Config::get('font_weight') as $fontWeight)
                                                                                <option
                                                                                    {{ $fontWeight == getStyles('welcome_description_font_weight') ? 'selected' : '' }}
                                                                                    value="{{ $fontWeight }}">
                                                                                    {{ $fontWeight }}</option>
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
                                    <style>
                                        .select2-selection__arrow{
                                            margin-right: 20px !important;
                                        }
                                    </style>
                                    @push('scripts')
                                        <script>
                                            $(document).ready(function() {
                                                $('.form-select').select2({
                                                    placeholder: "Select an Option",
                                                    allowClear: true
                                                });

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
                                            });
                                        </script>
                                    @endpush
                                </div><!-- .card-inner -->

                            </div><!-- .card-aside-wrap -->
                        </div><!-- .card -->
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
