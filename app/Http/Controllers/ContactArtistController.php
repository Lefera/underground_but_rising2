<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Artist;
use App\Models\Message;
use Illuminate\Support\Facades\Auth;

class ContactArtistController extends Controller
{
    /**
     * Affiche le formulaire "Contacter l’artiste"
     * Accessible uniquement par un utilisateur connecté
     */
    public function showForm($artistId)
    {
        // Vérifie que l’artiste existe
        $artist = Artist::findOrFail($artistId);

        // Affiche la vue du formulaire de contact artiste
        return view('front.artists.contact', compact('artist'));
    }

    /**
     * Envoie un message interne d’un fan vers un artiste
     * Le message est stocké dans la table "messages"
     */
    public function sendMessage(Request $request, $artistId)
    {
        // Sécurité : l’utilisateur doit être connecté
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        // Validation du contenu du message
        $request->validate([
            'message' => 'required|string|min:10',
        ]);

        // Vérifie que l’artiste existe
        $artist = Artist::findOrFail($artistId);

        // Sécurité : l’artiste doit être lié à un compte utilisateur
        if (!$artist->user_id) {
            return back()->with('error', "Cet artiste n'est pas encore joignable.");
        }

        // Création du message dans la messagerie interne
        Message::create([
    'sender_id'   => auth()->id(),
    'receiver_id' => $artist->user_id, // PAS artist->id
    'body'        => $request->message,
]);

        // Redirection vers la boîte d’envoi avec message de confirmation
        return redirect()
            ->route('messages.sent')
            ->with('success', 'Votre message a bien été envoyé à l’artiste.');
    }
}
