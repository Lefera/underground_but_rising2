@extends('layouts.app')

@section('content')

<link rel="stylesheet" href="{{ asset('css/messaging.css') }}">

<div class="messaging-container">

    <h1 class="messaging-title">Conversation</h1>

    {{-- Message principal --}}
    <div class="message-block">
        <div class="message-meta">
            De : {{ $message->sender->name ?? 'Inconnu' }}  
            | À : {{ $message->receiver->name ?? 'Inconnu' }}  
            | {{ $message->created_at->format('d/m/Y H:i') }}
        </div>

        <div class="message-body">{{ $message->body }}</div>
    </div>

    {{-- Réponses --}}
    @foreach($message->replies as $reply)
        <div class="message-block">
            <div class="message-meta">
                {{ $reply->sender->name }} → {{ $reply->receiver->name }}  
                | {{ $reply->created_at->format('d/m/Y H:i') }}
            </div>

            <div class="message-body">{{ $reply->body }}</div>
        </div>
    @endforeach

    {{-- Formulaire de réponse --}}
    <form action="{{ route('messages.reply', $message->id) }}" method="POST">
        @csrf

        <textarea name="body" rows="4"
            placeholder="Écrire une réponse..."
            style="width:100%; background:#111; color:#e5e5e5; border:1px solid #3d2b1f; padding:10px; border-radius:6px;"
            required></textarea>

        <button class="btn-reply">Envoyer la réponse</button>
    </form>

</div>

@endsection
