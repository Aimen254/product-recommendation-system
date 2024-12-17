@component('mail::message')
# Feedback
<p><b>Name:</b> {{$data['name']}}</p>
<p><b>Email:</b> {{$data['email']}}</p>
<p><b>Message:</b> {{$data['message']}}</p>
Thanks,<br>
{{ config('app.name') }}
@endcomponent
