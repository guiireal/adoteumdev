<?php

use App\Http\Controllers\Auth\GithubController;
use App\Http\Livewire\Components\HomeScreen;
use App\Http\Livewire\Components\SplashScreen;
use Illuminate\Support\Facades\Route;
use Laravel\Socialite\Facades\Socialite;

Route::get('/', SplashScreen::class)->name('app.splash');
Route::get('/home', HomeScreen::class)->name('app.home');


Route::prefix('auth')->name('auth.')->group(function () {
    Route::prefix('github')->name('github.')->group(function () {
        Route::get('redirect', function () {
            return Socialite::driver('github')->redirect();
        })->name('redirect');

        Route::get('callback', GithubController::class)->name('callback');
    });
});
