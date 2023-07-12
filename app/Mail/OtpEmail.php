<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;


class OtpEmail extends Mailable
{

//    use Queueable;
    public $username;
    public $name;
    public $otp;
    public $token;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($emailUsername,$emailName,$otp,$token)
    {
        $this->username=$emailUsername;
        $this->name=$emailName;
        $this->otp=$otp;
        $this->token=$token;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('info@lvitaapp.com','Lvita')->subject("Lvita OTP")->view('email.otp-email')->with([
            'username' => $this->username,
            'name' => $this->name,
            'otp' => $this->otp,
            'token' => $this->token,
        ]);
    }
}
