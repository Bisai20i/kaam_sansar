<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class VerificationMail extends Mailable
{
    use Queueable, SerializesModels;

    public $admin;
    public $password;

     /**
     * Create a new message instance.
     *
     * @param $admin
     * @param $password
     */
    public function __construct($admin, $password)
    {
        $this->admin = $admin;
        $this->password = $password;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Your Admin Account Details')
                    ->view('email.admincredentials')
                    ->with([
                        'email' => $this->admin->email,
                        'password' => $this->password,
                        'fullName' => $this->admin->fullName,
                    ]);
    }
}
