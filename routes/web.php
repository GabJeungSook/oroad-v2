<?php

use App\Models\Request;
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

})->name('dashboard');

Route::get('/admin/dashboard', function () {
    return view('admin.dashboard');
})->middleware(['auth', 'verified', 'role:ADMIN'])->name('admin.dashboard');

Route::get('/admin/campuses', function () {
    return view('admin.campus');
})->middleware(['auth', 'verified', 'role:ADMIN'])->name('admin.campus');

Route::get('/admin/courses', function () {
    return view('admin.course');
})->middleware(['auth', 'verified', 'role:ADMIN'])->name('admin.course');

Route::get('/admin/user-types', function () {
    return view('admin.user-type');
})->middleware(['auth', 'verified', 'role:ADMIN'])->name('admin.user-type');

Route::get('/admin/documents', function () {
    return view('admin.document');
})->middleware(['auth', 'verified', 'role:ADMIN'])->name('admin.document');

Route::get('/admin/pending-requests', function () {
    return view('admin.pending-request');
})->middleware(['auth', 'verified', 'role:ADMIN'])->name('admin.pending-request');


//routes for requestor

Route::get('/requestor/request-document', function () {
    return view('requestor.request-document');
})->middleware(['auth', 'verified', 'role:REQUESTOR'])->name('requestor.request-document');

Route::get('/requestor/update-user-information', function () {
    return view('requestor.forms.update-user-information');
})->middleware(['auth', 'verified', 'role:REQUESTOR'])->name('requestor.update-user-information');

Route::get('/requestor/edit-request/{request}', function ($request) {
    $request = Request::findOrFail($request);
    return view('requestor.forms.edit-request', ['record' => $request]);
})->middleware(['auth', 'verified', 'role:REQUESTOR'])->name('requestor.edit-request');

Route::get('/requestor/view-request/{request}', function ($request) {
    $request = Request::findOrFail($request);
    return view('requestor.view-request', ['record' => $request]);
})->middleware(['auth', 'verified', 'role:REQUESTOR'])->name('requestor.view-request');



Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('auth/google', [GoogleAuthController::class, 'redirect'])->name('google-auth');
Route::get('auth/google/callback', 'App\Http\Controllers\GoogleAuthController@googleCallback');
// Route::middleware(['auth:sanctum', 'verified'])->get('redirects', 'App\Http\Controllers\HomeController@index')->name('redirect');

require __DIR__.'/auth.php';
