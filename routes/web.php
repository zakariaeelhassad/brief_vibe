<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
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

Route::get('/login' , [sessionController::class , 'create']);
Route::post('/login' , [sessionController::class , 'store']);

Route::post('/logout', [sessionController::class, 'destroy'])
->name('logout');



Route::put('/profile/update', [ProfilController::class, 'update'])->name('profile.update');


// Route::post('/', function(){

//     request()->validate([
//         'name' => ['required', 'string', 'min:3'],
//         'email' => ['required' , 'string', 'lowercase', 'email', 'max:255'],
//         'password' => ['required']
//     ]);

//     user::create([
//         'name'=> request('name'),
//         'email'=>request('email'),
//         'password'=>request(('password'))
//     ]);

//     return redirect(('/login'));
// });



Route::get('/home', [HomeController::class, 'index']);
