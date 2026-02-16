<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;

use Illuminate\Support\Facades\Mail;
use App\Mail\ContactMail;
use App\Mail\ContactReplyMail;

class ContactController extends Controller
{
    public function index()
    {
        return view('front.contact');
    }

    public function send(Request $request)
    {
        // Sécurité honeypot anti robots
        if ($request->filled('website')) {
            return back();
        }

        // Validation
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'subject' => 'nullable|string|max:255',
            'message' => 'required|string|min:10',
        ]);

        // Sauvegarde en base
      $contact = Contact::create($validated);


        // Envoi email ADMIN
        Mail::to('leferae@gmail.com')->send(new ContactMail($contact));

        // Pause 1 seconde avant le 2e email
        sleep(1);

        // Email réponse automatique à l’utilisateur
        Mail::to($contact->email)->send(new ContactReplyMail($contact));

        return back()->with('success', 'Message envoyé avec succès ! Nous vous répondrons très bientôt.');
    }
}
