<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Auth::routes();

Route::view('/', 'welcome')->middleware('guest');

Route::view('/home', 'home')->name('home')->middleware('auth');
