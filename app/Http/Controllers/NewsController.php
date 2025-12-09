<?php

namespace App\Http\Controllers;

use App\Models\News;
use App\Models\Artist;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    public function index()
    {
        $news = News::latest()->paginate(6);
        return view('front.news.index', compact('news'));
    }

 public function show($slug)
{
    $news = News::where('slug', $slug)->with('artists', 'images')->firstOrFail();
    return view('front.news.show', compact('news'));
}


}
