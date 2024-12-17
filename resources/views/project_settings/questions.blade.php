@extends('layouts.app')
@section('content')
@php
    $styles = getStyles([
    "question_page_title_color", "question_page_description_color", "question_page_button_background_color", "question_page_button_text_color", "question_title_font_family",
    "question_description_font_family", "question_title_font_weight", "question_description_font_weight", "mcqs_answer_font_weight", "mcqs_answer_font_size", "question_title_font_size",
    "question_description_font_size", "arrow_color", "previous_text", "previous_button_text_color", "question_hover_color", "previous_text_font_family", "previous_text_font_size", "new_question_font_family",
    "new_question_font_weight", "next_button_text", "btn_hover_color", "next_button_text_font_family", "next_button_font_weight", "button_text_color", "end_button_background_color", "new_question_color",
    "new_question_background_color", "skip_button_text", "skip_button_text_font_family", "skip_button_font_weight", "skip_button_text_color", "skip_button_background_color", "new_question_text_min_length",
    "new_question_text_max_length", "new_question_text_error_message", "text_placeholder_text", "email_placeholder_text", "number_placeholder_text"
    ]);
@endphp
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
                                                <h5 class="nk-block-title">Question Type MCQs</h5>
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
                                                                            name="question_page_title_color"
                                                                            value="{{(getValue($styles, 'question_page_title_color')) ? getValue($styles, 'question_page_title_color') : '#002B5C' }}">
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
                                                                            name="question_page_description_color"
                                                                            value="{{(getValue($styles, 'question_page_description_color')) ? getValue($styles, 'question_page_description_color') : '#002B5C' }}">
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
                                                                            name="question_page_button_background_color"
                                                                            value="{{ (getValue($styles, 'question_page_button_background_color')) ? getValue($styles, 'question_page_button_background_color') : '#D60C8C' }}">
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
                                                                            name="question_page_button_text_color"
                                                                            value="{{(getValue($styles, 'question_page_button_text_color')) ? getValue($styles, 'question_page_button_text_color') : '#ffffff' }}">
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
                                                                        <select name="question_title_font_family"
                                                                            class="form-select form-control form-control-lg"
                                                                            data-search="on">
                                                                            <option></option>
                                                                            @foreach ($fonts as $font)
                                                                                <option
                                                                                    {{ $font->google_fonts == getValue($styles, 'question_title_font_family') ? 'selected' : '' }}
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
                                                                        <select name="question_description_font_family"
                                                                            class="form-select form-control form-control-lg"
                                                                            data-search="on">
                                                                            <option></option>
                                                                            @foreach ($fonts as $font)
                                                                                <option
                                                                                    {{ $font->google_fonts == getValue($styles, 'question_description_font_family') ? 'selected' : '' }}
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
                                                                        <select name="question_title_font_weight"
                                                                            class="form-select form-control form-control-lg"
                                                                            data-search="on">
                                                                            <option></option>
                                                                            @foreach (Config::get('font_weight') as $fontWeight)
                                                                                <option
                                                                                    {{ $fontWeight == getValue($styles, 'question_title_font_weight') ? 'selected' : '' }}
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
                                                                        <select name="question_description_font_weight"
                                                                            class="form-select form-control form-control-lg"
                                                                            data-search="on">
                                                                            <option></option>
                                                                            @foreach (Config::get('font_weight') as $fontWeight)
                                                                                <option
                                                                                    {{ $fontWeight == getValue($styles, 'question_description_font_weight') ? 'selected' : '' }}
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
                                                                    <label class="form-label" for="title">MCQs answer
                                                                        Font
                                                                        Weight</label>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-9">
                                                                <div class="form-group">
                                                                    <div class="form-control-wrap">
                                                                        <select name="mcqs_answer_font_weight"
                                                                            class="form-select form-control form-control-lg"
                                                                            data-search="on">
                                                                            <option></option>
                                                                            @foreach (Config::get('font_weight') as $fontWeight)
                                                                                <option
                                                                                    {{ $fontWeight == getValue($styles, 'mcqs_answer_font_weight') ? 'selected' : '' }}
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
                                                                    <label class="form-label" for="title">MCQs answer
                                                                        Font
                                                                        Size</label>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-9">
                                                                <div class="form-group">
                                                                    <div class="form-control-wrap">
                                                                        <input type="text" class="form-control"
                                                                            name="mcqs_answer_font_size"
                                                                            value="@if (getValue($styles, 'mcqs_answer_font_size')) {{ getValue($styles, 'mcqs_answer_font_size') }}@else{{ 9 }} @endif">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <h5 class="my-5">General Settings</h5>
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
                                                                            name="question_title_font_size"
                                                                            value="@if (getValue($styles, 'question_title_font_size')) {{ getValue($styles, 'question_title_font_size') }}@else{{ 9 }} @endif">
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
                                                                            name="question_description_font_size"
                                                                            value="@if (getValue($styles, 'question_description_font_size')) {{ getValue($styles, 'question_description_font_size') }}@else{{ 9 }} @endif">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row g-3 align-center">
                                                            <div class="col-lg-3">
                                                                <div class="form-group">
                                                                    <label class="form-label" for="title">Arrow
                                                                        Color</label>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-9">
                                                                <div class="form-group">
                                                                    <div class="form-control-wrap">
                                                                        <input type="text" class="form-control demo"
                                                                            name="arrow_color"
                                                                            value="{{ (getValue($styles, 'arrow_color')) ? getValue($styles, 'arrow_color') : '#d60c8c' }}">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row g-3 align-center">
                                                            <div class="col-lg-3">
                                                                <div class="form-group">
                                                                    <label class="form-label" for="title">Previous Text
                                                                        </label>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-9">
                                                                <div class="form-group">
                                                                    <div class="form-control-wrap">
                                                                        <input type="text" class="form-control"
                                                                            name="previous_text"
                                                                            value="@if (getValue($styles, 'previous_text')) {{ getValue($styles, 'previous_text') }}@else Vorige @endif">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row g-3 align-center">
                                                            <div class="col-lg-3">
                                                                <div class="form-group">
                                                                    <label class="form-label" for="title">Previous Button Text
                                                                        Color</label>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-9">
                                                                <div class="form-group">
                                                                    <div class="form-control-wrap">
                                                                        <input type="text" class="form-control demo"
                                                                            name="previous_button_text_color"
                                                                            value="{{ (getValue($styles, 'previous_button_text_color')) ? getValue($styles, 'previous_button_text_color') : '#d60c8c' }}">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row g-3 align-center">
                                                            <div class="col-lg-3">
                                                                <div class="form-group">
                                                                    <label class="form-label" for="title">Question Hover
                                                                        Color</label>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-9">
                                                                <div class="form-group">
                                                                    <div class="form-control-wrap">
                                                                        <input type="text" class="form-control demo"
                                                                            name="question_hover_color"
                                                                            value="{{ (getValue($styles, 'question_hover_color')) ? getValue($styles, 'question_hover_color') : '#d60c8c' }}">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row g-3 align-center">
                                                            <div class="col-lg-3">
                                                                <div class="form-group">
                                                                    <label class="form-label" for="title">Previous Text
                                                                        Font
                                                                        Family</label>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-9">
                                                                <div class="form-group">
                                                                    <div class="form-control-wrap">
                                                                        <select name="previous_text_font_family"
                                                                            class="form-select form-control form-control-lg"
                                                                            data-search="on">
                                                                            <option></option>
                                                                            @foreach ($fonts as $font)
                                                                                <option
                                                                                    {{ $font->google_fonts == getValue($styles, 'previous_text_font_family') ? 'selected' : '' }}
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
                                                                    <label class="form-label" for="title">
                                                                        Previous Text Font Size</label>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-9">
                                                                <div class="form-group">
                                                                    <div class="form-control-wrap">
                                                                        <input type="text" class="form-control"
                                                                            name="previous_text_font_size"
                                                                            value="@if (getValue($styles, 'previous_text_font_size')) {{ getValue($styles, 'previous_text_font_size') }}@else{{ 29 }} @endif">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        

                                                        <h5 class="my-5">Question type Image, Numeric, Email, Text and MQC's multiple answers(General Settings)</h5>

                                                        <div class="row g-3 align-center">
                                                            <div class="col-lg-3">
                                                                <div class="form-group">
                                                                    <label class="form-label" for="title">New Question
                                                                        Font
                                                                        Family</label>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-9">
                                                                <div class="form-group">
                                                                    <div class="form-control-wrap">
                                                                        <select name="new_question_font_family"
                                                                            class="form-select form-control form-control-lg"
                                                                            data-search="on">
                                                                            <option></option>
                                                                            @foreach ($fonts as $font)
                                                                                <option
                                                                                    {{ $font->google_fonts == getValue($styles, 'new_question_font_family') ? 'selected' : '' }}
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
                                                                    <label class="form-label" for="title">New Question
                                                                        Font
                                                                        Weight</label>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-9">
                                                                <div class="form-group">
                                                                    <div class="form-control-wrap">
                                                                        <select name="new_question_font_weight"
                                                                            class="form-select form-control form-control-lg"
                                                                            data-search="on">
                                                                            <option></option>
                                                                            @foreach (Config::get('font_weight') as $fontWeight)
                                                                                <option
                                                                                    {{ $fontWeight == getValue($styles, 'new_question_font_weight') ? 'selected' : '' }}
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
                                                                    <label class="form-label" for="title">Question BG
                                                                        Color</label>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-9">
                                                                <div class="form-group">
                                                                    <div class="form-control-wrap">
                                                                        <input type="text" class="form-control demo"
                                                                            name="new_question_background_color"
                                                                            value="{{(getValue($styles, 'new_question_background_color')) ? getValue($styles, 'new_question_background_color') : '#002B5C' }}">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="row g-3 align-center">
                                                            <div class="col-lg-3">
                                                                <div class="form-group">
                                                                    <label class="form-label" for="title">Image
                                                                        Description Color</label>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-9">
                                                                <div class="form-group">
                                                                    <div class="form-control-wrap">
                                                                        <input type="text" class="form-control demo"
                                                                            name="new_question_color"
                                                                            value="{{(getValue($styles, 'new_question_color')) ? getValue($styles, 'new_question_color') : '#002B5C' }}">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="row g-3 align-center">
                                                            <div class="col-lg-3">
                                                                <div class="form-group">
                                                                    <label class="form-label" for="title">Next Button
                                                                        Text</label>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-9">
                                                                <div class="form-group">
                                                                    <div class="form-control-wrap">
                                                                        <input type="text" class="form-control"
                                                                            name="next_button_text"
                                                                            value="@if (getValue($styles, 'next_button_text')) {{ getValue($styles, 'next_button_text') }}@else  Volgende @endif">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="row g-3 align-center">
                                                            <div class="col-lg-3">
                                                                <div class="form-group">
                                                                    <label class="form-label" for="title">Next & Skip Buttons Text Hover
                                                                        Color</label>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-9">
                                                                <div class="form-group">
                                                                    <div class="form-control-wrap">
                                                                        <input type="text" class="form-control demo"
                                                                            name="btn_hover_color"
                                                                            value="{{ (getValue($styles, 'btn_hover_color')) ? getValue($styles, 'btn_hover_color') : '#d60c8c' }}">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="row g-3 align-center">
                                                            <div class="col-lg-3">
                                                                <div class="form-group">
                                                                    <label class="form-label" for="title">Button Font
                                                                        Family</label>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-9">
                                                                <div class="form-group">
                                                                    <div class="form-control-wrap">
                                                                        <select name="next_button_text_font_family"
                                                                            class="form-select form-control form-control-lg"
                                                                            data-search="on">
                                                                            <option></option>
                                                                            @foreach ($fonts as $font)
                                                                                <option
                                                                                    {{ $font->google_fonts == getValue($styles, 'next_button_text_font_family') ? 'selected' : '' }}
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
                                                                    <label class="form-label" for="title">Button Font
                                                                        Weight</label>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-9">
                                                                <div class="form-group">
                                                                    <div class="form-control-wrap">
                                                                        <select name="next_button_font_weight"
                                                                            class="form-select form-control form-control-lg"
                                                                            data-search="on">
                                                                            <option></option>
                                                                            @foreach (Config::get('font_weight') as $fontWeight)
                                                                                <option
                                                                                    {{ $fontWeight == getValue($styles, 'next_button_font_weight') ? 'selected' : '' }}
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
                                                                    <label class="form-label" for="title">Next Button Text
                                                                        Color</label>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-9">
                                                                <div class="form-group">
                                                                    <div class="form-control-wrap">
                                                                        <input type="text" class="form-control demo"
                                                                            name="button_text_color"
                                                                            value="{{ (getValue($styles, 'button_text_color')) ? getValue($styles, 'button_text_color') : '#002B5C' }}">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row g-3 align-center">
                                                            <div class="col-lg-3">
                                                                <div class="form-group">
                                                                    <label class="form-label" for="title">Next Button
                                                                        BG Color</label>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-9">
                                                                <div class="form-group">
                                                                    <div class="form-control-wrap">
                                                                        <input type="text" class="form-control demo"
                                                                            name="end_button_background_color"
                                                                            value="{{ (getValue($styles, 'end_button_background_color')) ? getValue($styles, 'end_button_background_color') : '#002B5C' }}">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        {{-- @s --}}
                                                        <div class="row g-3 align-center">
                                                            <div class="col-lg-3">
                                                                <div class="form-group">
                                                                    <label class="form-label" for="title">Skip Button
                                                                        Text</label>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-9">
                                                                <div class="form-group">
                                                                    <div class="form-control-wrap">
                                                                        <input type="text" class="form-control"
                                                                            name="skip_button_text"
                                                                            value="@if (getValue($styles, 'skip_button_text')) {{ getValue($styles, 'skip_button_text') }}@else  Skip @endif">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="row g-3 align-center">
                                                            <div class="col-lg-3">
                                                                <div class="form-group">
                                                                    <label class="form-label" for="title">Skip Button Font
                                                                        Family</label>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-9">
                                                                <div class="form-group">
                                                                    <div class="form-control-wrap">
                                                                        <select name="skip_button_text_font_family"
                                                                            class="form-select form-control form-control-lg"
                                                                            data-search="on">
                                                                            <option></option>
                                                                            @foreach ($fonts as $font)
                                                                                <option
                                                                                    {{ $font->google_fonts == getValue($styles, 'skip_button_text_font_family') ? 'selected' : '' }}
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
                                                                    <label class="form-label" for="title">Skip Button Font
                                                                        Weight</label>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-9">
                                                                <div class="form-group">
                                                                    <div class="form-control-wrap">
                                                                        <select name="skip_button_font_weight"
                                                                            class="form-select form-control form-control-lg"
                                                                            data-search="on">
                                                                            <option></option>
                                                                            @foreach (Config::get('font_weight') as $fontWeight)
                                                                                <option
                                                                                    {{ $fontWeight == getValue($styles, 'skip_button_font_weight') ? 'selected' : '' }}
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
                                                                    <label class="form-label" for="title">Skip Button Text
                                                                        Color</label>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-9">
                                                                <div class="form-group">
                                                                    <div class="form-control-wrap">
                                                                        <input type="text" class="form-control demo"
                                                                            name="skip_button_text_color"
                                                                            value="{{ (getValue($styles, 'skip_button_text_color')) ? getValue($styles, 'skip_button_text_color') : '#002B5C' }}">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row g-3 align-center">
                                                            <div class="col-lg-3">
                                                                <div class="form-group">
                                                                    <label class="form-label" for="title">Skip Button
                                                                        BG Color</label>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-9">
                                                                <div class="form-group">
                                                                    <div class="form-control-wrap">
                                                                        <input type="text" class="form-control demo"
                                                                            name="skip_button_background_color"
                                                                            value="{{ (getValue($styles, 'skip_button_background_color')) ? getValue($styles, 'skip_button_background_color') : '#002B5C' }}">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        {{-- @e --}}

                                                        <h5 class="nk-block-title my-5">Configuration question type: Text
                                                        </h5>

                                                        <div class="row g-3 align-center">
                                                            <div class="col-lg-3">
                                                                <div class="form-group">
                                                                    <label class="form-label" for="title">Text Min
                                                                        Length</label>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-9">
                                                                <div class="form-group">
                                                                    <div class="form-control-wrap">
                                                                        <input type="number" class="form-control"
                                                                            name="new_question_text_min_length"
                                                                            value="{{(getValue($styles, 'new_question_text_min_length')) ? getValue($styles, 'new_question_text_min_length') : 5 }}">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="row g-3 align-center">
                                                            <div class="col-lg-3">
                                                                <div class="form-group">
                                                                    <label class="form-label" for="title">Text Max
                                                                        Length</label>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-9">
                                                                <div class="form-group">
                                                                    <div class="form-control-wrap">
                                                                        <input type="number" class="form-control"
                                                                            name="new_question_text_max_length"
                                                                            value="{{(getValue($styles, 'new_question_text_max_length')) ? getValue($styles, 'new_question_text_max_length') : 20 }}">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="row g-3 align-center">
                                                            <div class="col-lg-3">
                                                                <div class="form-group">
                                                                    <label class="form-label" for="title">Error Message
                                                                        for text</label>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-9">
                                                                <div class="form-group">
                                                                    <div class="form-control-wrap">
                                                                        <input type="text" class="form-control"
                                                                            name="new_question_text_error_message"
                                                                            value="@if (getValue($styles, 'new_question_text_error_message')) {{ getValue($styles, 'new_question_text_error_message') }}@else Invalid length @endif">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="row g-3 align-center">
                                                            <div class="col-lg-3">
                                                                <div class="form-group">
                                                                    <label class="form-label" for="title">Text
                                                                        Placeholder Text</label>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-9">
                                                                <div class="form-group">
                                                                    <div class="form-control-wrap">
                                                                        <input type="text" class="form-control"
                                                                            name="text_placeholder_text"
                                                                            value="@if (getValue($styles, 'text_placeholder_text')) {{ getValue($styles, 'text_placeholder_text') }}@else Enter Text @endif">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <h5 class="nk-block-title my-5">Configuration question type: Email
                                                        </h5>

                                                        <div class="row g-3 align-center">
                                                            <div class="col-lg-3">
                                                                <div class="form-group">
                                                                    <label class="form-label" for="title">Email
                                                                        Placeholder Text</label>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-9">
                                                                <div class="form-group">
                                                                    <div class="form-control-wrap">
                                                                        <input type="text" class="form-control"
                                                                            name="email_placeholder_text"
                                                                            value="@if (getValue($styles, 'email_placeholder_text')) {{ getValue($styles, 'email_placeholder_text') }}@else Enter Email @endif">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <h5 class="nk-block-title my-5">Configuration question type:
                                                            Numeric</h5>

                                                        <div class="row g-3 align-center">
                                                            <div class="col-lg-3">
                                                                <div class="form-group">
                                                                    <label class="form-label" for="title">Numeric
                                                                        Placeholder Text</label>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-9">
                                                                <div class="form-group">
                                                                    <div class="form-control-wrap">
                                                                        <input type="text" class="form-control"
                                                                            name="number_placeholder_text"
                                                                            value="@if (getValue($styles, 'number_placeholder_text')) {{ getValue($styles, 'number_placeholder_text') }}@else Enter a Number @endif">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        {{-- New question section end --}}

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
