<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Track extends Model
{
    use HasFactory;

    protected $fillable = [
        'artist_id',
        'title',
        'audio_file',
        'youtube_link'
    ];

    public function artist()
    {
        return $this->belongsTo(Artist::class);
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
