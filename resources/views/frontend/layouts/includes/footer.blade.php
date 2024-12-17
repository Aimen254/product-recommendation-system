<style>
    .nk-footer{
        display: none;
        border-top: none;
    }
    @media (min-width: 992px){
        .nk-footer{
        display: block;
    }
    }
</style>
<div class="nk-footer nk-footer-fluid bg-transparent">
    <div class="container-xl">
        <div class="nk-footer-wrap  justify-content-center">
            <div class="nk-footer-copyright"> © {{ now()->year }} {{ $activeProject->account->settings && $activeProject->account->settings->company_name ? $activeProject->account->settings->company_name : ''}} | All rights reserved
            </div>
        </div>
    </div>
</div>
