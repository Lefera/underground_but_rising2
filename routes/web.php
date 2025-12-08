<?php 

use Illuminate\Support\Facades\Route;

// Controllers
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ArtistController;
use App\Http\Controllers\GenreController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\RevelationController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\Admin\MessageAdminController;

// Accueil
Route::get('/', [HomeController::class, 'index'])->name('home');

// Tableau de bord admin (quand connecté)
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Gestion du profil utilisateur
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Affichage des artistes
Route::get('/artistes', [ArtistController::class, 'index'])->name('artists.index');
Route::get('/artistes/{artist:slug}', [ArtistController::class, 'show'])->name('artists.show');

// Affichage des top-rising-stars
Route::get('/revelations', [ArtistController::class, 'revelations'])
    ->name('revelations');


// Abonnement / Désabonnement
Route::post('/artistes/{artist}/follow', [ArtistController::class, 'follow'])
    ->middleware('auth')
    ->name('artists.follow');

Route::post('/artistes/{artist}/unfollow', [ArtistController::class, 'unfollow'])
    ->middleware('auth')
    ->name('artists.unfollow');


// Genres
Route::resource('genres', GenreController::class)->only(['index', 'show']);

// Actualités
Route::get('/news', [NewsController::class, 'index'])->name('news.index');
Route::get('/news/{slug}', [NewsController::class, 'show'])->name('news.show');

// Contact
Route::get('/contact', [ContactController::class, 'index'])->name('contact');
Route::post('/contact', [ContactController::class, 'send'])->name('contact.send');


// ADMIN CONTACT
Route::middleware(['auth'])->prefix('admin')->group(function () {
Route::get('/contacts', [App\Http\Controllers\Admin\ContactAdminController::class, 'index'])->name('admin.contacts');
Route::get('/contacts/{id}', [App\Http\Controllers\Admin\ContactAdminController::class, 'show'])->name('admin.contacts.show');
Route::delete('/contacts/{id}', [App\Http\Controllers\Admin\ContactAdminController::class, 'destroy'])->name('admin.contacts.destroy');
Route::get('/contacts-stat', [App\Http\Controllers\Admin\ContactAdminController::class, 'stats'])->name('admin.contacts.stats');


Route::get('/messages', [MessageAdminController::class, 'index'])->name('admin.messages.index');
    Route::get('/messages/{id}', [MessageAdminController::class, 'show'])->name('admin.messages.show');
    Route::delete('/messages/{id}', [MessageAdminController::class, 'destroy'])->name('admin.messages.destroy');
});

require __DIR__.'/auth.php';
