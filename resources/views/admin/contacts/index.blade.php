@extends('layouts.app')

@section('content')

<div class="admin-container">
    <h2>Messages reçus</h2>

    @if(session('success'))
        <p class="alert alert-success">{{ session('success') }}</p>
    @endif

    <table class="table-admin">
        <thead>
            <tr>
                <th>Nom</th>
                <th>Email</th>
                <th>Sujet</th>
                <th>Reçu le</th>
                <th>Actions</th>
            </tr>
        </thead>

        <tbody>
            @foreach($contacts as $contact)
            <tr>
                <td>{{ $contact->name }}</td>
                <td>{{ $contact->email }}</td>
                <td>{{ $contact->subject }}</td>
                <td>{{ $contact->created_at->format('d/m/Y') }}</td>
                <td>
                    <a href="{{ route('admin.contacts.show', $contact->id) }}" class="btn-view">Voir</a>
                    <form action="{{ route('admin.contacts.destroy', $contact->id) }}" method="POST" style="display:inline-block">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn-delete">Supprimer</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    {{ $contacts->links() }}
</div>

@endsection
