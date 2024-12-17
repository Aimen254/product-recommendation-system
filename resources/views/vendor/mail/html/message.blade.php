@component('mail::layout')
{{-- Header --}}
<style>
    .header{
        padding: 8px 0 0 0 !important;
    }
</style>
@slot('header')
@component('mail::header', ['url' => config('app.url')])
<center><img src="{{ asset('images/logo-dark.png') }}" alt="logo"></center><br>
@endcomponent
@endslot

{{-- Body --}}
{{ $slot }}

{{-- Subcopy --}}
@isset($subcopy)
@slot('subcopy')
@component('mail::subcopy')
{{ $subcopy }}
@endcomponent
@endslot
@endisset

{{-- Footer --}}
@slot('footer')
@component('mail::footer')
© {{ date('Y') }} {{ config('app.name') }}. @lang('All rights reserved.')
@endcomponent
@endslot
@endcomponent
