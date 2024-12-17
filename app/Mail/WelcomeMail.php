<?php

namespace App\Mail;

use Carbon\Carbon;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Support\Facades\DB;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Password;
use Illuminate\Contracts\Queue\ShouldQueue;

class WelcomeMail extends Mailable
{
    use Queueable, SerializesModels;
    protected $data;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $data = $this->data;
        $email = $data['email'];
        $user = User::where('email', $email)->first();
        if ($user) {
            $token = Password::getRepository()->create($user);
            DB::table('password_resets')->insert([
                'email' => $email,
                'token' => $token,
                'created_at' => Carbon::now()
            ]);
            $link = env('ADMIN_URL') . 'reset-password/' . $token . '?email=' . urlencode($email);
            return $this->subject("Welcome to our website!")
                ->markdown('emails.welcome')
                ->with(['data' => $data, 'link' => $link]);
        } else {
            return $this->subject("Welcome to our website!")
                ->markdown('emails.welcome')
                ->with(['data' => $data]);
        }
    }
}
