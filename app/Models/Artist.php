<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\News;

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

    public function news()
{
    return $this->belongsToMany(News::class, 'artist_news');
}
}
