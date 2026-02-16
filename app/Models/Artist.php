<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Storage;
use App\Models\User;
use App\Models\News;
use App\Models\Track;
use App\Models\Genre;

class Artist extends Model
{
    /*
    |--------------------------------------------------------------------------
    | Mass assignment
    |--------------------------------------------------------------------------
    */
    protected $fillable = [
        'name',
        'slug',
        'bio',
        'photo',
        'banner',   // ✅ NEW
        'genre_id',
        'city',
        'views'     // ✅ NEW
    ];

    /*
    |--------------------------------------------------------------------------
    | Route Model Binding
    |--------------------------------------------------------------------------
    */
    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    /*
    |--------------------------------------------------------------------------
    | Relations
    |--------------------------------------------------------------------------
    */

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function tracks()
    {
        return $this->hasMany(Track::class);
    }

    public function news()
    {
        return $this->belongsToMany(News::class, 'artist_news');
    }

    public function genre()
    {
        return $this->belongsTo(Genre::class);
    }

    public function followers()
    {
        return $this->belongsToMany(User::class, 'artist_user')
                    ->withTimestamps();
    }

    /*
    |--------------------------------------------------------------------------
    | Scopes
    |--------------------------------------------------------------------------
    */

    public function scopeRising(Builder $query)
    {
        return $query
            ->withCount('followers')
            ->havingRaw('followers_count >= 100');
    }

    public function scopeNewTalents(Builder $query)
    {
        return $query
            ->withCount('followers')
            ->havingRaw('followers_count <= 20');
    }

    /*
    |--------------------------------------------------------------------------
    | Accessors BADGES
    |--------------------------------------------------------------------------
    */

    public function getIsRisingAttribute(): bool
    {
        return ($this->followers_count ?? 0) >= 100;
    }

    public function getIsNewTalentAttribute(): bool
    {
        return ($this->followers_count ?? 0) <= 20;
    }

    public function getBadgeLabelAttribute(): ?string
    {
        if ($this->is_rising) return 'Rising ⭐';
        if ($this->is_new_talent) return 'Nouveau';
        return null;
    }

    public function getBadgeClassAttribute(): ?string
    {
        if ($this->is_rising) return 'badge-rising';
        if ($this->is_new_talent) return 'badge-new';
        return null;
    }

    /*
    |--------------------------------------------------------------------------
    | NEW — Accessors images + vues
    |--------------------------------------------------------------------------
    */

    // URL avatar
    public function getPhotoUrlAttribute()
    {
        return $this->photo
            ? Storage::url('artists/'.$this->photo)
            : asset('images/avatar.png');
    }

    // URL bannière
    public function getBannerUrlAttribute()
    {
        return $this->banner
            ? Storage::url('artists/'.$this->banner)
            : asset('images/default-banner.jpg');
    }

    // compteur formaté (ex: 12 540)
    public function getFormattedViewsAttribute()
    {
        return number_format($this->views);
    }

    public function likes()
{
    return $this->morphMany(Like::class, 'likeable');
}

public function comments()
{
    return $this->morphMany(Comment::class, 'commentable')
                ->whereNull('parent_id');
}
}
