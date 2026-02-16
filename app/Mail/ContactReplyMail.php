<?php

namespace App\Mail;

use App\Models\Contact; // ✅ Contact et non Message
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ContactReplyMail extends Mailable
{
    use Queueable, SerializesModels;

    // Données du message de contact
    public $contact;

    /**
     * Création du mail de réponse automatique
     */
    public function __construct(Contact $contact)
    {
        $this->contact = $contact;
    }

    /**
     * Construction de l'email
     */
    public function build()
    {
        return $this->subject('Merci pour votre message')
                    ->view('emails.contact-reply')
                    ->with([
                        'contact' => $this->contact,
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
