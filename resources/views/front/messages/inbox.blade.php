@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="{{ asset('css/messaging.css') }}">

<div class="messaging-container">
    <h1 class="messaging-title">Messages reçus</h1>

    @if($messages->count() === 0)
        <p style="color:#aaa;">Aucun message reçu.</p>
    @else
        <table class="message-list">
            <tr>
                <th>De</th>
                <th>Message</th>
                <th>Date</th>
            </tr>

            @foreach($messages as $msg)
                <tr onclick="window.location='{{ route('messages.show', $msg->id) }}'"
                    class="{{ $msg->is_read ? '' : 'unread' }}">

                    <td>{{ $msg->sender->name ?? 'Utilisateur supprimé' }}</td>
                    <td>{{ Str::limit($msg->body, 60) }}</td>
                    <td>{{ $msg->created_at->format('d/m/Y H:i') }}</td>
                </tr>
            @endforeach
        </table>
    @endif
</div>
@endsection
