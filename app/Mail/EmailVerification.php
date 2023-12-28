<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Env;

class EmailVerification extends Mailable
{
    use Queueable, SerializesModels;
    private $verificationCode;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($verificationCode)
    {
        $this->verificationCode = $verificationCode;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from(env("MAIL_FROM_ADDRESS"), env("APP_NAME"))
            ->subject("Email Verification")
            ->view('email-verification', ["verificationCode" => $this->verificationCode]);

    }
}
