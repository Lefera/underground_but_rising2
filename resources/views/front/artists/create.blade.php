@extends('layouts.app')

@section('title', 'Ajouter un artiste')

@section('content')

<section class="artist-create">

    <div class="artist-create__card">

        <header class="artist-create__header">
            <i class="fas fa-user-plus"></i>
            <h2>Ajouter un artiste</h2>
        </header>

        @if ($errors->any())
            <div class="form-alert">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li><i class="fas fa-circle-exclamation"></i> {{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('artists.store') }}" method="POST" enctype="multipart/form-data" class="artist-form">
            @csrf

            <div class="form-grid">

                <div class="form-field">
                    <label>Nom de l'artiste</label>
                    <input type="text" name="name" value="{{ old('name') }}" required>
                </div>

                <div class="form-field">
                    <label>Genre musical</label>
                    <input type="text" name="genre" value="{{ old('genre') }}">
                </div>

                <div class="form-field">
                    <label>Pays / Ville</label>
                    <input type="text" name="location" value="{{ old('location') }}">
                </div>

                <div class="form-field form-field--full">
                    <label>Biographie</label>
                    <textarea name="bio" rows="4">{{ old('bio') }}</textarea>
                </div>

                <div class="form-field form-field--full upload">
                    <label>Photo</label>
                    <input type="file" name="photo" accept="image/*" id="photoInput">
                    <img id="preview" class="preview-img">
                </div>

            </div>

            <div class="form-actions">
                <a href="{{ route('artists.index') }}" class="btn btn-light">Annuler</a>
                <button type="submit" class="btn btn-primary">Enregistrer</button>
            </div>


            <a href="{{ route('admin.dashboard') }}" class="btn-back">
        <i class="fas fa-arrow-left"></i>
        Dashboard
    </a>

    
    </div>

</section>


<script>
document.getElementById('photoInput').onchange = e => {
    const file = e.target.files[0];
    if(!file) return;

    const preview = document.getElementById('preview');
    preview.src = URL.createObjectURL(file);
    preview.style.display = "block";
};
</script>

@endsection
