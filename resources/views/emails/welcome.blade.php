<x-guest-layout>
    <style>
        .button {
            background-color: #000;
            border: none;
            color: white;
            padding: 15px 32px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            margin: 4px 2px;
            cursor: pointer;
        }

    </style>
    <link rel="stylesheet" href="css/emails/style-email.css">
    <div class="nk-app-root">
        <div class="nk-block">
            <div class="card card-bordered">
                <div class="card-inner">
                    <table class="email-wraper">
                        <tr>
                            <td class="py-5">
                                <table class="email-header">
                                    <tbody>
                                        <tr>
                                            <td class="text-center pb-4">
                                                <a href="#"><img class="email-logo"
                                                        src="{{ asset('images/logo-dark.svg') }}" alt="logo"></a>
                                                <p class="email-title">Hi {{ $data['first_name'] }},<br> 
                                                    Your Survey Rocks account is created.</p>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                                <table class="email-body">
                                    <tbody>
                                        <tr>
                                            <td class="p-3 p-sm-5">
                                                <p><strong>You can login via <a href="accounts.surveyrocks.io">
                                                            accounts.surveyrocks.io</a> with your
                                                        email address :{{ $data['email'] }}</strong>,</p>
                                                <p>Please Click below Button to change your password for security
                                                    reasons.</p>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                               <center> <a href="{{ $link }}" class="button">Create Your Account</a></center>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                                <table class="email-footer">
                                    <tbody>
                                        <tr>
                                            <td class="text-center pt-4">
                                                <p>Best regards, <br>
                                                    Team Survey Rocks</p>
                                                <p class="email-copyright-text">Copyright © {{ now()->year }} Survey Rocks. Allrights reserved.</p>
                                                <p class="fs-12px pt-4">This email was sent to you as a registered
                                                    member of <a href="https://surveyrocks.com">surveyrocks.com</a>.</p>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        </div><!-- .nk-block -->
    </div>
</x-guest-layout>

