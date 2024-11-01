<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SocialLogin\SocialLoginController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});


/*
    social login controller route is here 
*/

Route::controller(SocialLoginController::class)->group(function(){
    Route::get('auth/redirection/{provider}','authProviderRedirect')->name('auth.redirection');
    Route::get('auth/{provider}/callback','socialAuthentication')->name('auth.callback');
});

/*
    social login controller route is here 
*/




Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
