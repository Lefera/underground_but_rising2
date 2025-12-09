<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use App\Models\Message;
use Illuminate\Queue\SerializesModels;

class ContactMail extends Mailable
{
    use Queueable, SerializesModels;

    public $data;

    public function __construct(Message $message)
    {
        $this->data = $message;
    }

    public function build()
    {
        return $this->subject('Nouveau message du formulaire')
                    ->view('emails.contact-admin')
                    ->with([
                        'data' => $this->data
                    ])
                    ->attach(
                        storage_path('app/public/artists/LOGO.jpg'),
                        [
                            'as'   => 'logo.jpg',
                            'mime' => 'image/jpeg',
                        ]
                    );
    }
}
