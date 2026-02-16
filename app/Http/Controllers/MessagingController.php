<?php

namespace App\Http\Controllers;

use App\Models\PrivateMessage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Message;

class MessagingController extends Controller
{
    // Liste des messages reçus
    public function inbox()
{
    $messages = Message::where('receiver_id', auth()->id())
        ->latest()
        ->get();

    return view('front.messages.inbox', compact('messages'));
}

    // Liste des messages envoyés
   public function sent()
{
    $messages = Message::where('sender_id', auth()->id())
        ->latest()
        ->get();

    return view('front.messages.sent', compact('messages'));
}

    // Voir la conversation complète
    public function show($id)
    {
        $message = PrivateMessage::findOrFail($id);

        // Marquer comme lu
        if ($message->receiver_id == Auth::id()) {
            $message->update(['is_read' => true]);
        }

        $replies = PrivateMessage::where('parent_id', $message->id)
            ->orderBy('created_at', 'asc')
            ->get();

        return view('front.messages.show', compact('message', 'replies'));
    }

    // Envoyer un message
    public function send(Request $request)
    {
        $request->validate([
            'receiver_id' => 'required|exists:users,id',
            'body' => 'required|min:2',
        ]);

        PrivateMessage::create([
            'sender_id' => Auth::id(),
            'receiver_id' => $request->receiver_id,
            'body' => $request->body,
            'is_read' => false,
        ]);

        return back()->with('success', 'Message envoyé avec succès');
    }

    // Répondre à un message
    public function reply(Request $request, $id)
    {
        $request->validate([
            'body' => 'required|min:2',
        ]);

        $parent = PrivateMessage::findOrFail($id);

        PrivateMessage::create([
            'sender_id' => Auth::id(),
            'receiver_id' => $parent->sender_id,
            'body' => $request->body,
            'parent_id' => $parent->id,
            'is_read' => false,
        ]);

        return back()->with('success', 'Réponse envoyée');
    }
}
