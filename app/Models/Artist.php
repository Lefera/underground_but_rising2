<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\News;
use App\Models\User;

class Artist extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'bio',
        'photo',
        'genre_id'
    ];

    public function genre()
    {
        return $this->belongsTo(Genre::class);
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function news()
    {
        return $this->belongsToMany(News::class, 'artist_news');
    }

    // *** Correction ici ***
    public function scopeFeatured($query)
    {
        return $query->where('featured', true);
    }

    public function tracks()
    {
        return $this->hasMany(Track::class);
    }

    // Followers via table pivot "artist_user"
    public function followers()
    {
        return $this->belongsToMany(User::class, 'artist_user')
                    ->withTimestamps();
    }

    // Badge Rising Star si +100 abonnés
    public function getIsRisingStarAttribute(): bool
    {
        return $this->followers()->count() >= 100;
    }
}
