<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Controllers (Front)
|--------------------------------------------------------------------------
*/
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ArtistController;
use App\Http\Controllers\GenreController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\TrackController;
use App\Http\Controllers\ContactArtistController;
use App\Http\Controllers\MessagingController;
use App\Http\Controllers\RevelationController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\CommentController;
/*
|--------------------------------------------------------------------------
| Controllers (Admin)
|--------------------------------------------------------------------------
*/
use App\Http\Controllers\Admin\MessageAdminController;
use App\Http\Controllers\Admin\ContactAdminController;
use App\Http\Controllers\Admin\AdminDashboardController;



/*
|--------------------------------------------------------------------------
| PAGE D'ACCUEIL (PUBLIC)
|--------------------------------------------------------------------------
*/
Route::get('/', [HomeController::class, 'index'])->name('home');



/*
|--------------------------------------------------------------------------
| PAGES LÉGALES (PUBLICES)
|--------------------------------------------------------------------------
*/
Route::view('/politique-confidentialite', 'legal.privacy')
    ->name('legal.privacy');

Route::view('/conditions-utilisation', 'legal.terms')
    ->name('legal.terms');

Route::view('/mentions-legales', 'legal.mentions')
    ->name('legal.mentions');



/*
|--------------------------------------------------------------------------
| PROFIL UTILISATEUR (AUTH)
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');


    Route::get('/forgot-password', [PasswordResetLinkController::class, 'create'])
    ->name('password.request');

Route::post('/forgot-password', [PasswordResetLinkController::class, 'store'])
    ->name('password.email');

});



/*
|--------------------------------------------------------------------------
| ARTISTES (PUBLIC)
|--------------------------------------------------------------------------
*/
Route::get('/artistes', [ArtistController::class, 'index'])->name('artists.index');
Route::get('/artistes/{artist:slug}', [ArtistController::class, 'show'])->name('artists.show');
Route::get('/revelations', [RevelationController::class, 'index'])
    ->name('revelations');
/*
|--------------------------------------------------------------------------
| FOLLOW / UNFOLLOW (AUTH)
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {

    Route::post('/artistes/{artist}/follow', [ArtistController::class, 'follow'])
        ->name('artists.follow');

    Route::post('/artistes/{artist}/unfollow', [ArtistController::class, 'unfollow'])
        ->name('artists.unfollow');

        Route::post('/like/{type}/{id}', [LikeController::class,'toggle'])
        ->name('like.toggle');

    Route::post('/comment/{type}/{id}', [CommentController::class,'store'])
        ->name('comment.store');

});



/*
|--------------------------------------------------------------------------
| GENRES (PUBLIC)
|--------------------------------------------------------------------------
*/
Route::resource('genres', GenreController::class)
    ->only(['index', 'show'])
    ->parameters(['genres' => 'genre:slug']);



/*
|--------------------------------------------------------------------------
| ACTUALITÉS (PUBLIC)
|--------------------------------------------------------------------------
*/
Route::get('/news', [NewsController::class, 'index'])->name('news.index');
Route::get('/news/{slug}', [NewsController::class, 'show'])->name('news.show');



/*
|--------------------------------------------------------------------------
| CONTACT PUBLIC
|--------------------------------------------------------------------------
*/
Route::get('/contact', [ContactController::class, 'index'])->name('contact');
Route::post('/contact', [ContactController::class, 'send'])->name('contact.send');



/*
|--------------------------------------------------------------------------
| CONTACT ARTISTE (AUTH)
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {

    Route::get('/artists/{artist}/contact', [ContactArtistController::class, 'showForm'])
        ->name('artists.contact.form');

    Route::post('/artists/{artist}/contact', [ContactArtistController::class, 'sendMessage'])
        ->name('artists.contact.send');

        Route::get('/artistes', [ArtistController::class, 'index'])
    ->name('artists.index');

});


/*
|--------------------------------------------------------------------------
| TRACKS + PHOTO ARTISTE (AUTH)
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {

    Route::get('/artistes/{artist:slug}/tracks/create', [TrackController::class, 'create'])
        ->name('tracks.create');

    Route::post('/artistes/{artist:slug}/tracks', [TrackController::class, 'store'])
        ->name('tracks.store');

    Route::post('/artistes/{artist:slug}/update-photo', [ArtistController::class, 'updatePhoto'])
        ->name('artists.updatePhoto');

});




/*
|--------------------------------------------------------------------------
| MESSAGERIE PRIVÉE (AUTH)
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->prefix('messages')->group(function () {

    Route::get('/inbox', [MessagingController::class, 'inbox'])->name('messages.inbox');
    Route::get('/sent', [MessagingController::class, 'sent'])->name('messages.sent');
    Route::get('/{id}', [MessagingController::class, 'show'])->name('messages.show');
    Route::post('/send', [MessagingController::class, 'send'])->name('messages.send');
    Route::post('/{id}/reply', [MessagingController::class, 'reply'])->name('messages.reply');

});



/*
|--------------------------------------------------------------------------
| ZONE ADMIN (AUTH + ADMIN ONLY 🔒)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'admin'])->prefix('admin')->group(function () {

    // Dashboard principal
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])
        ->name('admin.dashboard');


    // CRUD Artistes (admin uniquement)
    Route::resource('artists', ArtistController::class)
        ->except(['index', 'show']);


    // News (admin)
    Route::get('/news/create', [NewsController::class, 'create'])->name('news.create');
    Route::post('/news', [NewsController::class, 'store'])->name('news.store');


    // Contacts admin
    Route::get('/contacts', [ContactAdminController::class, 'index'])->name('admin.contacts');
    Route::get('/contacts/{id}', [ContactAdminController::class, 'show'])->name('admin.contacts.show');
    Route::delete('/contacts/{id}', [ContactAdminController::class, 'destroy'])->name('admin.contacts.destroy');
    Route::get('/contacts-stat', [ContactAdminController::class, 'stats'])->name('admin.contacts.stats');


    // Messages admin
    Route::get('/messages', [MessageAdminController::class, 'index'])->name('admin.messages.index');
    Route::get('/messages/{id}', [MessageAdminController::class, 'show'])->name('admin.messages.show');
    Route::delete('/messages/{id}', [MessageAdminController::class, 'destroy'])->name('admin.messages.destroy');


    // Recherche admin
  
});



/*
|--------------------------------------------------------------------------
| AUTH Breeze
|--------------------------------------------------------------------------
*/
require __DIR__.'/auth.php';
