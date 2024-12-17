<div class="background">
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-sm-0 col-xl-3 col-md-6 col-0 d-flex align-items-center">
                <span class="banner ">
                    <img src="{{ $activeProject->account->settings ? ($activeProject->account->settings->logo ? asset('storage/images/' . $activeProject->account->settings->logo) : asset('images/default.png')) : asset('images/default.png') }}"
                        class="survey-header-logo">
                </span>
            </div>
            @php
            $project = App\Models\Project::where('uuid',currentProjectUuid())->first();
            $style = App\Models\ProjectSetting::where([
                'project_id' => $project->id,
                'key' => 'home_icon',
            ])->first();
            $vorige = App\Models\ProjectSetting::where([
                'project_id' => $project->id,
                'key' => 'previous_text',
            ])->first();
            


            @endphp
            <div class="col-lg-6 col-sm-12 col-xl-6 col-md-6 col-12 d-flex align-items-center">
                <em class="icon ni ni-chevron-left-circle mobile-icon previous-button"></em>
                <span class="ml-2 vorige previous-button">
                    {{ isset($vorige) ? $vorige->value : 'Vorige' }}
                </span>
                <div class="nav m-auto">
                    <span class="icons">
                        <span><a href="{{ route('survey.index', currentProjectUuid()) }}" swqqqqq
                                @if (Route::currentRouteName() == 'project') class="active" @endif>
                                <img src="@if ($style) {{ asset('storage/images/' . $style->value) }} @else {{ asset('images/home.svg') }} @endif"></i></a></span>
                    </span>
                </div>
            </div>
            <div class="col-lg-3 col-sm-0 col-xl-3 col-md-0 col-0"></div>
        </div>
    </div>
</div>