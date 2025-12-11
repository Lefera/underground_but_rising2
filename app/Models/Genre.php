<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Genre extends Model
{
   public function artists()
{
    return $this->hasMany(Artist::class);
}
protected $fillable = ['name', 'slug', 'image'];

}
