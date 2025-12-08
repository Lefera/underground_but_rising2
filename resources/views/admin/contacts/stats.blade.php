@extends('layouts.app')

@section('content')
<div class="admin-container">
    <h2>Statistiques des messages</h2>

    <table class="table-admin">
        <thead>
        <tr><th>Mois</th><th>Total reçus</th></tr>
        </thead>
        <tbody>
        @foreach($stats as $s)
            <tr>
                <td>{{ DateTime::createFromFormat('!m', $s->month)->format('F') }}</td>
                <td>{{ $s->total }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
@endsection
