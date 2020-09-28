<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Auth::routes();

Route::view('/', 'welcome')->middleware('guest');

Route::middleware('auth')->group(function () {
    Route::view('/home', 'home')->name('home');

    Route::put('github-token', 'PersistGithubTokenController');
});
