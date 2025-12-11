<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Artist;

class ContactArtistController extends Controller
{
    // Afficher le formulaire
    public function showForm($artistId)
    {
        $artist = Artist::findOrFail($artistId);

        return view('front.artists.contact', compact('artist'));
    }

    // Traiter l’envoi du message (optionnel pour plus tard)
    public function sendMessage(Request $request, $artistId)
    {
        $request->validate([
            'message' => 'required|min:10'
        ]);

        // Plus tard tu pourras envoyer un email ou enregistrer le message en base
        return back()->with('success', 'Message envoyé avec succès.');
    }
}
