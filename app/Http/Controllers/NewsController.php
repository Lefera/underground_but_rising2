<?php

namespace App\Http\Controllers;

use App\Models\News;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    public function index()
    {
        $news = News::latest()->paginate(10);
        return view('front.news.index', compact('news'));
    }

   public function show($slug)
{
    $news = News::where('slug', $slug)->firstOrFail();
    return view('front.news.show', compact('news'));
}

}
