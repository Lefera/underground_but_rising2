@extends('layouts.app')

@section('content')
<div class="message-details">
    <h2>Détails du message</h2>

    <p><strong>Nom :</strong> {{ $message->name }}</p>
    <p><strong>Email :</strong> {{ $message->email }}</p>
    <p><strong>Sujet :</strong> {{ $message->subject ?? '—' }}</p>

    <p><strong>Message :</strong><br>
        {{ $message->message }}
    </p>

    <a href="{{ route('admin.messages.index') }}" class="btn-back">
        <i class="fas fa-arrow-left"></i> Retour
    </a>
</div>
@endsection
