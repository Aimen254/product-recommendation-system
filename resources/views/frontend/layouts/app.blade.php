<!DOCTYPE html>
<html lang="zxx" class="js">

<head>
    @php
    $project = App\Models\Project::where('uuid', currentProjectUuid())->first();
    $welcomePage = App\Models\welcomePage::where('project_id', $project->id)->first();
    @endphp
    <base href="../">
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}" />

    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no">
    <meta name="description" content="{{ $project->description }}">
    <!-- Fav Icon  -->

    <link rel="shortcut icon" href="{{ $activeProject->account->settings? ($activeProject->account->settings->favicon? asset('storage/images/' . $activeProject->account->settings->favicon): asset('images/favicon.png')): asset('images/favicon.png') }}">
    <link rel="apple-touch-icon" href="{{ $activeProject->account->settings? ($activeProject->account->settings->favicon? asset('storage/images/' . $activeProject->account->settings->favicon): asset('images/favicon.png')): asset('images/favicon.png') }}">
    <link rel="apple-touch-icon-precomposed apple-touch-icon" sizes="57x57" href="{{ $activeProject->account->settings? ($activeProject->account->settings->favicon? asset('storage/images/' . $activeProject->account->settings->favicon): asset('images/favicon.png')): asset('images/favicon.png') }}" />
    <link rel="apple-touch-icon-precomposed apple-touch-icon" sizes="72x72" href="{{ $activeProject->account->settings? ($activeProject->account->settings->favicon? asset('storage/images/' . $activeProject->account->settings->favicon): asset('images/favicon.png')): asset('images/favicon.png') }}" />
    <link rel="apple-touch-icon-precomposed apple-touch-icon" sizes="114x114" href="{{ $activeProject->account->settings? ($activeProject->account->settings->favicon? asset('storage/images/' . $activeProject->account->settings->favicon): asset('images/favicon.png')): asset('images/favicon.png') }}" />
    <link rel="apple-touch-icon-precomposed apple-touch-icon" sizes="144x144" href="{{ $activeProject->account->settings? ($activeProject->account->settings->favicon? asset('storage/images/' . $activeProject->account->settings->favicon): asset('images/favicon.png')): asset('images/favicon.png') }}" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" />
    <link href='https://fonts.googleapis.com/css?family={{ getSelectedFont() }}' rel='stylesheet'>
    <!-- Page Title  -->
    <title>
        {{ ($activeProject->account->settings && $activeProject->account->settings->company_name? $activeProject->account->settings->company_name: 'Survey Rocks') .' - ' .($project ? $project->title : '') }}
    </title>
    <!-- StyleSheets  -->
    <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css" />
    <link rel="stylesheet" href="{{ asset('/css/backend/dashlite_style.css') }}" />
    <link rel="stylesheet" href="{{ asset('/css/frontend/project_styles_css.css') }}" />
    <style>
        .body-class {
            background-size: 80%;
            background-repeat: no-repeat;
            background-position: 60% -18%;
        }

        @media (max-width: 992px) {
            .body-class {
                background-size: 157% !important;
                background-position: 46% 77%;
            }
        }
    </style>
    @stack('styles')
</head>

<body class="nk-body npc-invest body-class" style="font-family: {{ getSelectedFont() }} !important; background-color:{{ getGeneralSettings() }}; background-image: url({{ asset('storage/images/' . backgroundImage()) }});">

    <div class="nk-app-root">
        <!-- wrap @s -->
        <div class="nk-wrap ">
            <!-- main header @s -->
            @include('frontend.layouts.includes.header')
            <!-- main header @e -->
            <!-- content @s -->
            <div class="nk-content nk-content-lg nk-content-fluid">
                @yield('content')
            </div>

            <!-- content @e -->
            <!-- footer @s -->
            @include('frontend.layouts.includes.footer')
            <!-- footer @e -->
        </div>
        <!-- wrap @e -->
    </div>
    <!-- app-root @e -->
    <!-- generic modal -->
    <div class="modal fade" id="ajax_model" role="dialog" data-backdrop="static">

        <div class="modal-dialog modal-md" role="document">
            <div class="modal-content" id="ajax_model_content">
            </div>
        </div>

    </div>
    <!-- JavaScript -->
    <script src="{{ asset('js/app.js') }}"></script>
    {{-- <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" /> --}}
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10.9.0"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
    <script type="text/javascript" src="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
    <script src="{{ asset('/js/backend/theme.js') }}"></script>
    <!-- page scripts -->
    @stack('scripts')
</body>

</html>