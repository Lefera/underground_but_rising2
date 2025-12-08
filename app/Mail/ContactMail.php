<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use App\Models\Message;
use Illuminate\Queue\SerializesModels;

class ContactMail extends Mailable
{
    use Queueable, SerializesModels;

     public $message;

    public function __construct(Message $message)
    {
        $this->message = $message;
    }
    public function build()
    {
        return $this->subject('Nouveau message du formulaire')
                    ->view('emails.contact-admin')
                    ->with(['message' => $this->message]);
    }
}
