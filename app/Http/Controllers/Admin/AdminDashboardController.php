<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Artist;
use App\Models\Track;
use App\Models\Message;
use App\Models\News;

class AdminDashboardController extends Controller
{
    public function index()
    {
        // ===== COUNTS =====
        $artistsCount  = Artist::count();
        $tracksCount   = Track::count();
        $messagesCount = Message::count();
        $newsCount     = News::count();

        // ===== LATEST =====
        $latestArtists  = Artist::latest()->take(5)->get();
        $latestTracks   = Track::with('artist')->latest()->take(5)->get();
        $latestMessages = Message::latest()->take(5)->get();
        $latestNews     = News::latest()->take(5)->get();

        return view('admin.dashboard', compact(
            'artistsCount',
            'tracksCount',
            'messagesCount',
            'newsCount',
            'latestArtists',
            'latestTracks',
            'latestMessages',
            'latestNews'
        ));
    }
}
