<div class="nk-block-head  pb-2">
    <div class="nk-block-head-content">
        <h2 class="nk-block-title fw-normal">{{ getActiveProject()->title }} - {{ getActiveAccount()->name }}</h2>
        <div class="nk-block-des">

        </div>
    </div>
</div>
<style>
    .copy-url{position:absolute;left:-1000px}
    svg {
    height: 35px;
    max-width: 100%;
}
</style>
<div class="d-flex justify-content-between">
    <ul class="nk-nav nav nav-tabs border-0">
        <li class="nav-item {{ Route::currentRouteName() == 'welcome_page.index' ? 'active-tab' : '' }} ">
            <a class="nav-link survey-builder-nav d-block text-center"
                href="{{ route('welcome_page.index', [currentAccount(), currentProject()]) }}">
                <em class="icon ni ni-home-fill d-block mb-1"></em>
                <span class="m-0">Welcome</span></a>
        </li>
        <li class="nav-item {{ Route::currentRouteName() == 'questions.index' ? 'active-tab' : '' }} ">
            <a class="nav-link survey-builder-nav d-block text-center"
                href="{{ route('questions.index', [currentAccount(), currentProject()]) }}">
                <em class="icon ni ni-notes-alt d-block mb-1"></em>
                <span class="m-0">Questions</span></a>
        </li>
        <li class="nav-item {{ Route::currentRouteName() == 'advice-logic.index' ? 'active-tab' : '' }} ">
            <a class="nav-link survey-builder-nav d-block text-center"
                href="{{ route('advice-logic.index', [currentAccount(), currentProject()]) }}">
                <em class="icon ni ni-chat-circle-fill d-block mb-1"></em>
                <span class="m-0">Advice</span></a>
        </li>
        <li class="nav-item {{ Route::currentRouteName() == 'styles.index' ? 'active-tab' : '' }} ">
            <a class="nav-link survey-builder-nav d-block text-center"
                href="{{ route('styles.index', [currentAccount(), currentProject()]) }}">
                <em class="icon ni ni-setting d-block mb-1"></em>
                <span class="m-0">Settings</span></a>
        </li>
        <li class="nav-item {{ Route::currentRouteName() == 'response.index' ? 'active-tab' : '' }} ">
            <a class="nav-link survey-builder-nav d-block text-center"
                href="{{ route('response.index', [currentAccount(), currentProject()]) }}">
                <em class="icon ni ni-view-grid-fill d-block mb-1"></em>
                <span class="m-0">Responses</span></a>
        </li>

        {{-- <li class="nav-item {{ Route::currentRouteName() == 'zapier-integration' ? 'active-tab' : '' }} ">
            <a class="nav-link survey-builder-nav d-block text-center"
                href="{{ route('zapier-integration', [currentAccount(), currentProject()]) }}">
                <em class="icon ni d-block"> <svg role="img" style="width: 35px;fill: #364a63;"  viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><title>Zapier</title><path d="M15 12.004c0 .893-.165 1.746-.461 2.535-.787.297-1.643.461-2.535.461h-.009c-.893 0-1.745-.165-2.534-.461C9.164 13.75 9 12.896 9 12.004v-.009c0-.893.164-1.745.461-2.534C10.25 9.164 11.103 9 11.995 9h.009c.893 0 1.748.164 2.535.462.297.788.461 1.641.461 2.535v.007zM23.835 10H16.83l4.948-4.952c-.39-.548-.82-1.06-1.295-1.533-.473-.474-.985-.907-1.53-1.296l-4.954 4.949V.165C13.35.061 12.686 0 12.004 0h-.01c-.68 0-1.346.061-1.995.165V7.17l-4.95-4.949c-.549.386-1.06.821-1.534 1.294-.474.474-.908.987-1.296 1.533L7.168 10H.165S0 11.316 0 11.995v.009c0 .68.061 1.348.165 1.995H7.17l-4.949 4.952c.777 1.096 1.733 2.051 2.827 2.83L10 16.831v7.004c.648.105 1.313.165 1.991.165h.017c.679 0 1.344-.06 1.991-.165v-7.004l4.952 4.95c.548-.375 1.06-.812 1.529-1.29h.005c.473-.465.906-.976 1.296-1.531l-4.95-4.949h7.004c.105-.645.165-1.304.165-1.98V12c0-.678-.06-1.343-.165-1.99"/></svg></em>
                <span class="m-0">Zapier Integration</span></a>
        </li> --}}
    </ul><!-- .nav-tabs -->
    <span class="align-self-center">
        <span class="copy-url" id="copy-url">
            @if(getActiveAccount()->settings && getActiveAccount()->settings->custom_domain && getActiveAccount()->settings->status=='active')
                      {{url(getActiveAccount()->settings->custom_domain.'/'.currentProject())}}
                    @else {{  route('survey.index',currentProject()) }}@endif
        </span>
        <div class="nk-refwg-url">
            <div class="form-control-wrap">
                <em class="icon ni ni-link-alt"></em>
                <a href="@if(getActiveAccount()->settings && getActiveAccount()->settings->custom_domain && getActiveAccount()->settings->status=='active')
                      {{url(getActiveAccount()->settings->custom_domain.'/'.currentProject())}}
                    @else {{  route('survey.index',currentProject()) }}@endif" target="_blank" id="refUrl">View Project</a>
                <span class="clipboard-init" data-clipboard-target="#copy-url" data-success="Copied"
                    data-text="Copy Link"><em class="clipboard-icon icon ni ni-copy"></em> <span
                        class="clipboard-text">Copy link</span></span>
            </div>
        </div>

    </span>
</div>
