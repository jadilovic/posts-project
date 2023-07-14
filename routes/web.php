<?php

use App\Http\Controllers\ChatController;
use App\Http\Controllers\FavoritesController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
use App\Models\Favorite;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [PostController::class, 'index'])->name('home');
Route::get('/all-posts/{categoryId}', [PostController::class, 'getAllPosts'])->name('posts');
Route::get('/posts/{post}', [PostController::class, 'show'])->name('posts.show');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/my-posts', [PostController::class, 'getMyPosts'])->name('myPosts');
    Route::get('/add-post', [PostController::class, 'createPost'])->name('addPostForm');
    Route::post('/posts', [PostController::class, 'store'])->name('store');

    Route::get('/posts/{id}/edit', [PostController::class, 'edit'])->name('posts.edit');
    Route::put('/posts/{id}', [PostController::class, 'update'])->name('posts.update');
    Route::delete('/posts/{id}', [PostController::class, 'destroy'])->name('posts.delete');

    Route::post('/favorites', [FavoritesController::class, 'store'])->name('favorites');
    Route::get('/my-favorites', [FavoritesController::class, 'index'])->name('myFavorites');
    Route::delete('/favorites/{postId}', [FavoritesController::class, 'destroy'])->name('favorite.delete');

    Route::get('/start-chat/{userId}', [ChatController::class, 'createChat'])->name('startChatForm');
    Route::post('/messages', [ChatController::class, 'store'])->name('message.store');
    Route::get('/chat/{chatId}', [ChatController::class, 'openChat'])->name('chatForm');
    Route::get('/chats', [ChatController::class, 'getMyChats'])->name('chats');
});

require __DIR__.'/auth.php';
require __DIR__.'/api.php';
