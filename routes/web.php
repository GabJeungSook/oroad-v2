<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\GoogleAuthController;

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    if(auth()->user()->role_id == 1)
    {
        return redirect()->route('admin.dashboard');
    }elseif(auth()->user()->role_id == 2)
    {
        return view('dashboard');
    }

});

Route::get('/admin/dashboard', function () {
    return view('admin.dashboard');
})->middleware(['auth', 'verified', 'role:ADMIN'])->name('admin.dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('auth/google', [GoogleAuthController::class, 'redirect'])->name('google-auth');
Route::get('auth/google/callback', 'App\Http\Controllers\GoogleAuthController@googleCallback');
// Route::middleware(['auth:sanctum', 'verified'])->get('redirects', 'App\Http\Controllers\HomeController@index')->name('redirect');

require __DIR__.'/auth.php';
