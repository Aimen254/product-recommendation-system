@component('mail::message')
Hi {{ $data['first_name'] }},<br> <br>
Your Survey Rocks account is created.
You can login via <a href="accounts.surveyrocks.io">accounts.surveyrocks.io</a><br>
<p>Create your account by clicking on the button below:</p>

@component('mail::button', ['url' => $link])
Create Account
@endcomponent

<p>Best regards, <br>
    Team {{ config('app.name') }}</p><br>
<p class="email-copyright-text">Copyright © {{ now()->year }} Survey Rocks. All
    rights reserved.</p>
<p class="fs-12px pt-4">This email was sent to you as a registered
    member of <a href="https://surveyrocks.com">surveyrocks.com</a>.</p>
@endcomponent