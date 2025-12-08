@extends('layouts.app')

@section('content')
<div class="admin-container">
    <h1 class="admin-title">Messages reçus</h1>

    @if(session('success'))
        <div class="alert-success">
            <i class="fas fa-check-circle"></i> {{ session('success') }}
        </div>
    @endif

    <table class="admin-table">
        <thead>
            <tr>
                <th>Nom</th>
                <th>Email</th>
                <th>Sujet</th>
                <th>Date</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
        @foreach($messages as $msg)
            <tr>
                <td>{{ $msg->name }}</td>
                <td>{{ $msg->email }}</td>
                <td>{{ $msg->subject ?? '—' }}</td>
                <td>{{ $msg->created_at->format('d/m/Y H:i') }}</td>
                <td class="actions">
                    <a href="{{ route('admin.messages.show', $msg->id) }}" class="btn-view">
                        <i class="fas fa-eye"></i>
                    </a>
                    <form action="{{ route('admin.messages.destroy', $msg->id) }}"
                          method="POST" onsubmit="return confirm('Supprimer ce message ?')">
                        @csrf
                        @method('DELETE')
                        <button class="btn-delete">
                            <i class="fas fa-trash-alt"></i>
                        </button>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

    <div class="pagination">
        {{ $messages->links() }}
    </div>
</div>
@endsection
