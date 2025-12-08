@extends('layouts.app')

@section('content')
<div class="admin-container">
    <h2>Détail du message</h2>

    <p><strong>Nom:</strong> {{ $contact->name }}</p>
    <p><strong>Email:</strong> {{ $contact->email }}</p>
    <p><strong>Sujet:</strong> {{ $contact->subject }}</p>
    <p><strong>Message:</strong><br>{{ $contact->message }}</p>

    <a href="{{ route('admin.contacts') }}" class="btn-view">Retour</a>
</div>
@endsection
