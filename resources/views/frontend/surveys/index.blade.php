<style>
    .title-color{
        color: {{$ProjectSetting && isset($ProjectSetting['welcome_page_title_color']) ? $ProjectSetting['welcome_page_title_color'] : '#002B5C'}};
        font-family: {{$ProjectSetting && isset($ProjectSetting['welcome_title_font_family']) ? $ProjectSetting['welcome_title_font_family'] : 'overpass'}};
        font-weight: {{$ProjectSetting && isset($ProjectSetting['welcome_title_font_weight']) ? $ProjectSetting['welcome_title_font_weight'] : '900'}};

    }

    .welcome-page-heading{
        color:{{$ProjectSetting && isset($ProjectSetting['welcome_page_description_color']) ? $ProjectSetting['welcome_page_description_color'] : '#002B5C'}};
        font-family: {{$ProjectSetting && isset($ProjectSetting['welcome_description_font_family']) ? $ProjectSetting['welcome_description_font_family'] : 'PT Serif'}};
        font-weight: {{$ProjectSetting && isset($ProjectSetting['welcome_description_font_weight']) ? $ProjectSetting['welcome_description_font_weight'] : '400'}};
    }

    .circle-button{
        color:{{$ProjectSetting && isset($ProjectSetting['welcome_page_button_text_color']) ? $ProjectSetting['welcome_page_button_text_color']  : '#ffffff'}};
        background:{{$ProjectSetting && isset($ProjectSetting['welcome_page_button_background_color']) ? $ProjectSetting['welcome_page_button_background_color'] : '#D60C8C'}};
        font-family: {{$ProjectSetting && isset($ProjectSetting['welcome_title_font_family']) ? $ProjectSetting['welcome_title_font_family'] : 'overpass'}};
        font-weight: {{$ProjectSetting && isset($ProjectSetting['welcome_title_font_weight']) ? $ProjectSetting['welcome_title_font_weight'] : '600'}};
    }
    .title-text{
        font-size: {{$ProjectSetting && isset($ProjectSetting['title_font_size']) ? $ProjectSetting['title_font_size'] .' !important' : 12}};
    }
    .welcome-page-heading{
        font-size: {{$ProjectSetting && isset($ProjectSetting['description_font_size']) ? $ProjectSetting['description_font_size'] .' !important' : 10}};
    }
    .mobile-icon{
        display: none;
    }
    .vorige{
        display: none;
    }
    @media (max-width: 992px) {
        .icons {
            position: fixed;
            bottom: 10px;
            left: 47%;
        }
        .title-color{
        color: {{$ProjectSetting && isset($ProjectSetting['welcome_page_title_color']) ? $ProjectSetting['welcome_page_title_color'] : '#002B5C'}};
        font-family: {{$ProjectSetting && isset($ProjectSetting['welcome_title_font_family']) ? $ProjectSetting['welcome_title_font_family'] : 'overpass'}};
        font-weight: {{$ProjectSetting && isset($ProjectSetting['welcome_title_font_weight']) ? $ProjectSetting['welcome_title_font_weight'] : '900'}};

    }

    .welcome-page-heading{
        color:{{$ProjectSetting && isset($ProjectSetting['welcome_page_description_color']) ? $ProjectSetting['welcome_page_description_color'] : '#002B5C'}};
        font-family: {{$ProjectSetting && isset($ProjectSetting['welcome_description_font_family']) ? $ProjectSetting['welcome_description_font_family'] : 'PT Serif'}};
        font-weight: {{$ProjectSetting && isset($ProjectSetting['welcome_description_font_weight']) ? $ProjectSetting['welcome_description_font_weight'] : '400'}};
    }

    .circle-button{
        color:{{$ProjectSetting && isset($ProjectSetting['welcome_page_button_text_color']) ? $ProjectSetting['welcome_page_button_text_color']  : '#ffffff'}};
        background:{{$ProjectSetting && isset($ProjectSetting['welcome_page_button_background_color']) ? $ProjectSetting['welcome_page_button_background_color'] : '#D60C8C'}};
        font-family: {{$ProjectSetting && isset($ProjectSetting['welcome_title_font_family']) ? $ProjectSetting['welcome_title_font_family'] : 'overpass'}};
        font-weight: {{$ProjectSetting && isset($ProjectSetting['welcome_title_font_weight']) ? $ProjectSetting['welcome_title_font_weight'] : '600'}};
    }
    .title-text{
        font-size: {{$ProjectSetting && isset($ProjectSetting['title_font_size']) ? $ProjectSetting['title_font_size'] .' !important' : 12}};
    }
    .welcome-page-heading{
        font-size: {{$ProjectSetting && isset($ProjectSetting['description_font_size']) ? $ProjectSetting['description_font_size'] .' !important' : 10}};
    }
    }
</style>
@extends('frontend.layouts.app')
@section('content')
    <div class="nk-content nk-content-fluid">
        <div class="container-xl wide-xl">
            <div class="nk-content-inner">
                <div class="nk-content-body">
                    <div class="nk-block">
                        <div class="row">
                            <div class="col-md-12" id="first_page">
                                <div class="logo text-center mt-3">
                                    <img class="logo_image"
                                        src="{{ $welcomePageData->image ? asset('storage/images/' . $welcomePageData->image) : asset('images/default.png') }}">
                                </div>
                                <div class="title text-center mt-3">
                                    <h4 class="title-text title-color">{{ $welcomePageData->title }}</h4>
                                </div>
                                <div class="description text-center mt-2 mb-5">
                                    <p class="welcome-page-heading container">
                                        {{ $welcomePageData->description }}
                                    </p>
                                </div>
                                <a href = "{{ count($project->questions) ? route('survey.start', currentProjectUuid()) : 'javascript:void(0)' }}">
                                    <div class="start-btn mt-3 text-center">
                                        <span class="circle-button">{{ $welcomePageData->button_text ?? 'Start' }}</span>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div><!-- .nk-block -->
                </div>
            </div>
        </div>
    </div>
@endsection
