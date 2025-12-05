<?php 

use Illuminate\Support\Facades\Route;

// Controllers
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ArtistController;
use App\Http\Controllers\GenreController;
use App\Http\Controllers\NewsController;

// Accueil
Route::get('/', [HomeController::class, 'index'])->name('home');

// Tableau de bord admin (quand connecté)
Route::get('/dashboard', function () {
    return view('front.dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Gestion du profil utilisateur
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Affichage des artistes (lecture uniquement)
Route::get('/artistes', [ArtistController::class, 'index'])->name('artists.index');
Route::get('/artistes/{artist:slug}', [ArtistController::class, 'show'])->name('artists.show');

// Genres
Route::resource('genres', GenreController::class)->only(['index', 'show']);

// Actualités
Route::get('/news', [NewsController::class, 'index'])->name('news.index');
Route::get('/news/{slug}', [NewsController::class, 'show'])->name('news.show');


// Contact
Route::view('/contact', 'contact')->name('contact');

require __DIR__.'/auth.php';
