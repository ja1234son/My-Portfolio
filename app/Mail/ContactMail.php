<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ContactMail extends Mailable
{
    use Queueable, SerializesModels;

    public array $details;

    public function __construct( array $details)
    {
        $this->details = $details;
    }

    public function build()
    {
        return $this->view('welcome')->with('details', $this->details);
    }
}