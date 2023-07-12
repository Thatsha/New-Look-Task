<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;


class UserEmail extends Mailable
{

//    use Queueable;
    public $username;
    public $password;
    public $name;
    public $newPassword;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($emailUsername,$emailPassword,$emailName,$newPasword=false)
    {
        $this->username=$emailUsername;
        $this->password=$emailPassword;
        $this->name=$emailName;
        $this->newPassword=$newPasword;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('info@lvitaapp.com','Lvita')->subject(($this->newPassword?"Lvita New Credentials":"Lvita Credentials"))->view('email.user-email')->with([
            'username' => $this->username,
            'password' => $this->password,
            'name' => $this->name,
            'newPassword' => $this->newPassword,
        ]);
    }
}
