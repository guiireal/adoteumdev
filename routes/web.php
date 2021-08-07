<?php

use App\Http\Controllers\Auth\GithubController;
use App\Http\Controllers\Auth\GoogleController;
use App\Http\Livewire\Components\DeveloperScreen;
use App\Http\Livewire\Components\HomeScreen;
use App\Http\Livewire\Components\InterestScreen;
use App\Http\Livewire\Components\PreferenceScreen;
use App\Http\Livewire\Components\SplashScreen;
use Illuminate\Support\Facades\Route;
use Laravel\Socialite\Facades\Socialite;

Route::get('/', SplashScreen::class)->name('app.splash');
Route::get('home', HomeScreen::class)->name('app.home');

Route::middleware('auth')->group(function () {
    Route::get('interesses', InterestScreen::class)->name('app.interests');
    Route::get('preferencias', PreferenceScreen::class)->name('app.preferences');
    Route::get('desenvolvedores', DeveloperScreen::class)->name('app.developers');
});


Route::prefix('auth')->name('auth.')->group(function () {
    Route::prefix('github')->name('github.')->group(function () {
        Route::get('redirect', function () {
            return Socialite::driver('github')->redirect();
        })->name('redirect');

        Route::get('callback', GithubController::class)->name('callback');
    });

    Route::prefix('google')->name('google.')->group(function () {
        Route::get('redirect', function () {
            return Socialite::driver('google')->redirect();
        })->name('redirect');
        Route::get('callback', GoogleController::class);
    });
});
