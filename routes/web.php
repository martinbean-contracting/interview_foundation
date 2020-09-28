<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Auth::routes();

Route::view('/', 'welcome')->middleware('guest');

Route::middleware('auth')->group(function () {
    Route::get('/home', 'HomeController')->name('home');

    Route::put('github-token', 'PersistGithubTokenController');
});
