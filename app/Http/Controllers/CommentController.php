<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Artist;
use App\Models\Track;
use App\Models\Comment;

class CommentController extends Controller
{
    public function store(Request $request, $type, $id)
    {
        $request->validate([
            'content' => 'required|string|max:500'
        ]);

        $model = $type === 'artist'
            ? Artist::findOrFail($id)
            : Track::findOrFail($id);

        $model->comments()->create([
            'user_id' => auth()->id(),
            'content' => $request->content,
            'parent_id' => $request->parent_id
        ]);

        return back();
    }
}
