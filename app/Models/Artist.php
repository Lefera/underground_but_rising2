<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Artist extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'bio',
        'photo',
        'genre_id'
    ];

    // Relation artiste → genre
    public function genre()
    {
        return $this->belongsTo(Genre::class);
    }

    // Permet de récupérer un artiste via son slug dans l'URL
    public function getRouteKeyName()
    {
        return 'slug';
    }
}
