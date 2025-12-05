@extends('layouts.app')

@section('title', 'Ajouter un artiste')

@section('content')
<div class="container mt-5">
    <div class="card p-4 shadow-sm">
        <h2 class="mb-4">Ajouter un artiste</h2>

        {{-- Messages d’erreurs --}}
        @if($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('artists.store') }}" enctype="multipart/form-data">
            @csrf

            <div class="mb-3">
                <label for="name" class="form-label">Nom de l'artiste*</label>
                <input type="text" id="name" name="name" class="form-control" value="{{ old('name') }}" required>
            </div>

            <div class="mb-3">
                <label for="bio" class="form-label">Biographie</label>
                <textarea id="bio" name="bio" rows="4" class="form-control">{{ old('bio') }}</textarea>
            </div>

            <div class="mb-3">
                <label for="genre_id" class="form-label">Genre musical*</label>
                <select id="genre_id" name="genre_id" class="form-select" required>
                    <option value="">Sélectionner</option>
                    @foreach($genres as $genre)
                        <option value="{{ $genre->id }}">{{ $genre->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label for="photo" class="form-label">Photo</label>
                <input type="file" id="photo" name="photo" class="form-control">
            </div>

            <button type="submit" class="btn btn-primary w-100">
                Enregistrer l’artiste
            </button>
        </form>
    </div>
</div>
@endsection
