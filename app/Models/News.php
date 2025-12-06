<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Artist;
use App\Models\NewsImage;


class News extends Model
{
  protected $fillable = [
    'title',
    'slug',
    'content',
    'photo',   // IMPORTANT
];

    public function artists()
{
    return $this->belongsToMany(Artist::class, 'artist_news');
}
public function images()
{
    return $this->hasMany(NewsImage::class);
}
}
