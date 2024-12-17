@extends('layouts.app')
@section('content')
    <!-- content @s -->
    <div class="nk-content nk-content-fluid">
        <div class="container-xl wide-xl">
            <div class="nk-content-inner">
                <div class="nk-content-body">
                    <div class="nk-block">
                        <div class="card card-bordered">
                            <div class="card-aside-wrap">
                                <div class="card-inner card-inner-lg">
                                    <div class="nk-block-head nk-block-head-lg">
                                        <div class="nk-block-between">
                                            <div class="nk-block-head-content">
                                                <h4 class="nk-block-title">Choose your two-factor authentication method</h4>
                                                <p>With two-factor authentication, you'll protect your account with both your
                                                     password and your phone.
                                                     @if(!(auth()->user()->two_factor_secret))
                                                     You will need an app like <b>Google Authenticator</b> to enable it.
                                                     @endif
                                                    </p>
                                                {{-- @if(auth()->user()->two_factor_secret)
                                                <h6>Two factor authentication is enabled.</h6>
                                                @else
                                                <h6>Two factor authentication is disabled</h6>
                                                @endif --}}
                                                <div class="nk-block-des">
                                                </div>
                                            </div>
                                            <div class="nk-block-head-content align-self-start d-lg-none">
                                                <a href="#" class="toggle btn btn-icon btn-trigger mt-n1"
                                                    data-target="userAside"><em class="icon ni ni-menu-alt-r"></em></a>
                                            </div>
                                        </div>
                                    </div><!-- .nk-block-head -->
                                        <form method="post" action="user/two-factor-authentication">
                                            @csrf
                                            @if(auth()->user()->two_factor_secret)
                                            @method('DELETE')
                                            <div class="form-group mt-2">
                                            <h6>QR Code</h6>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-6">
                                                {!! auth()->user()->twoFactorQrCodeSvg() !!}
                                                </div>
                                                <div class="col-lg-6">
                                                    <h6>Recovery Code</h6>
                                                @foreach (json_decode(decrypt(auth()->user()->two_factor_recovery_codes), true) as $code)
                                                <li>{!! $code !!}</li>
                                                 @endforeach
                                                </div>
                                            </div>
                                                <div class="col-lg-">
                                                    <div class="form-group mt-2">
                                                       <button class="btn btn-danger">Disable</button>
                                                    </div>
                                                </div>
                                            
                                            @else
                                           
                                            <button class="btn btn-primary">Enable</button>
                                            @endif
                                        </form>   

                                </div>
                               @include('users.partials.sidebar')
                                
                            </div><!-- .card-aside-wrap -->
                        </div><!-- .card -->
                    </div><!-- .nk-block -->
                </div>
            </div>
        </div>
    </div>
    <!-- content @e -->
@endsection
