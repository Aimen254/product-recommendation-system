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
                                <iframe src="https://zapier.com" width="90%" height="1000" title="Iframe Example"
                                    style="
                                        width: 100%;
                                        border: none;
                                       "></iframe>
                                {{-- <div class="card-inner card-inner-lg">

                                </div><!-- .card-inner --> --}}

                            </div><!-- .card-aside-wrap -->
                        </div><!-- .card -->
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
