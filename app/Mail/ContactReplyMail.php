<?php

namespace App\Mail;

use App\Models\Message;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ContactReplyMail extends Mailable
{
    use Queueable, SerializesModels;

    public $data; // Le message stocké

    public function __construct(Message $message)
    {
        $this->data = $message;
    }

   public function build()
{
    return $this->subject('Merci pour votre message')
                ->view('emails.contact-reply')
                ->with([
                    'data' => $this->data,
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
