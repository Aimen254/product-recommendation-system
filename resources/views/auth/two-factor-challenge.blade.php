<x-guest-layout>
    <style>
        .cursor-pointer{
            cursor:pointer;
        }
    </style>
    <div class="nk-content ">
        <div class="nk-block nk-block-middle nk-auth-body  wide-xs">
            <div class="brand-logo pb-4 text-center">
                <a href="#" class="logo-link">
                    <img class="logo-light logo-img logo-img-lg" src="{{ asset('images/logo.svg') }}" srcset="{{ asset('images/logo2x.svg') }} 2x" alt="logo">
                                <img class="logo-dark logo-img logo-img-lg" src="{{ asset('images/logo-dark.svg') }}" srcset="{{ asset('images/logo-dark2x.svg') }} 2x" alt="logo-dark">
                </a>
            </div>
        <div x-data="{ recovery: false }">
            
            <div class="card card-bordered">
                <div class="card-inner card-inner-lg">
                    <div class="mb-4 text-sm text-gray-600" x-show="! recovery">
                        {{ __('Please confirm access to your account by entering the authentication code provided by your authenticator application.') }}
                    </div>
        
                    <div class="mb-4 text-sm text-gray-600" x-show="recovery">
                        {{ __('Please confirm access to your account by entering one of your emergency recovery codes.') }}
                    </div>
            <x-jet-validation-errors class="mb-4 text-danger" />

            <form method="POST" action="{{ route('two-factor.login') }}">
                @csrf

                <div class="mt-4" x-show="! recovery">
                    <x-jet-input id="code" class="block mt-1 w-full form-control" type="text" inputmode="numeric" name="code" autofocus x-ref="code" autocomplete="one-time-code" />
                </div>

                <div class="mt-4" x-show="recovery">
                    <x-jet-input id="recovery_code" class="block mt-1 w-full form-control" type="text" name="recovery_code" x-ref="recovery_code" autocomplete="one-time-code" />
                </div>
                
                <div class="flex items-center d-flex justify-content-between mt-4" >
                    <a class="cursor-pointer"
                                    x-show="! recovery"
                                    x-on:click="
                                        recovery = true;
                                        $nextTick(() => { $refs.recovery_code.focus() })
                                    ">
                        {{ __('Use a recovery code') }}
                </a>

                    <a  class="cursor-pointer"
                                    x-show="recovery"
                                    x-on:click="
                                        recovery = false;
                                        $nextTick(() => { $refs.code.focus() })
                                    ">
                        {{ __('Use an authentication code') }}
                    </a>

                    <button class="ml-4 btn btn-primary">
                        {{ __('Authenticate') }}
                    </button>
                </div>
            </form>
        </div>
    </div>
        </div>
    </div>
</div>
</x-guest-layout>
