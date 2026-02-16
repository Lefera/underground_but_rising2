<?php

namespace App\Http\Controllers;

use App\Models\Artist;
use App\Models\Track;
use Illuminate\Http\Request;

class LikeController extends Controller
{
    public function toggle($type, $id)
    {
        $model = $type === 'artist'
            ? Artist::findOrFail($id)
            : Track::findOrFail($id);

        $like = $model->likes()
            ->where('user_id', auth()->id())
            ->first();

        if ($like) {
            $like->delete();
        } else {
            $model->likes()->create([
                'user_id' => auth()->id()
            ]);
        }

        return back();
    }
}
