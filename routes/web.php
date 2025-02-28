<?php

use App\Http\Controllers\AfichageProfilController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\commentController;
use App\Http\Controllers\FollowController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MonPosteController;
use App\Http\Controllers\PosteController;
use App\Http\Controllers\ProfilController;
use App\Http\Controllers\sessionController;
use App\Models\User;
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

Route::get('/', [HomeController::class, 'index'])->name('/');

Route::get('/login', function () {
    return view('login');
});

// Route::get('/signup', function () {
//     return view('signup'); 
// });

Route::get('/modificationProfil', function () {
    return view('modificationProfil'); 
});
Route::get('/search', [HomeController::class, 'search'])->name('search');


Route::get('/signup' , [AuthController::class , 'create']);
Route::post('/register' , [AuthController::class , 'register']);

Route::get('/monPost' , [MonPosteController::class , 'create'])->middleware('auth');
Route::post('/monPost', [MonPosteController::class, 'store'])->middleware('auth')->name('monPost');

Route::get('/login' , [sessionController::class , 'create']);
Route::post('/login' , [sessionController::class , 'store']);

Route::post('/logout', [sessionController::class, 'destroy'])
->name('logout');



Route::put('/profile/update', [ProfilController::class, 'update'])->name('profile.update');

Route::delete('/profile', [ProfilController::class , 'delete'])->name('profile.delete');

Route::get('/home', [HomeController::class, 'index']);

Route::post('/home/{userId}', [FollowController::class, 'follow']);

Route::middleware('auth')->group(function(){
    Route::post('follow/{userId}' , [FollowController::class , 'follow'])->name('follow');
    Route::post('/unfollow/{userId}', [FollowController::class, 'unfollow'])->name('unfollow');
    Route::post('/follow/accept/{userId}', [FollowController::class, 'acceptFollow'])->name('acceptFollow');
    Route::post('/follow/reject/{userId}', [FollowController::class, 'rejectFollow'])->name('rejectFollow');
    Route::get('/follow/requests', [FollowController::class, 'pendingRequests'])->name('follow.requests');
    Route::get('/friends', [FollowController::class, 'friendsList'])->name('friends.list');
});

Route::get('/post' , [PosteController::class , 'create']);
Route::delete('/post/{id}', [MonPosteController::class, 'delete'])->name('post.delete');
Route::put('/post/update/{id}', [MonPosteController::class, 'update'])->name('post.update');

Route::get('/profil/{id}', [AfichageProfilController::class, 'profil'])->name('profil.show');

Route::post('/post/{id}/like', [PosteController::class, 'likePost'])->name('post.like');

Route::post('/post/{id}/comment', [commentController::class, 'store'])->name('post.comment');


