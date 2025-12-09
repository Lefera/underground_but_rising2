<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NewsImage extends Model
{
protected $fillable = ['news_id', 'file_name'];

    public function news()
    {
        return $this->belongsTo(News::class);
    }
}
