<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use App\Models\Contact; // ✅ ON UTILISE Contact
use Illuminate\Queue\SerializesModels;

class ContactMail extends Mailable
{
    use Queueable, SerializesModels;

    // Les données du message de contact
    public $contact;

    /**
     * Création du mail avec un Contact
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
        return $this->subject('Nouveau message du formulaire de contact')
                    ->view('emails.contact-admin')
                    ->with([
                        'contact' => $this->contact
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
