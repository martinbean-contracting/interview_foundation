<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Auth::routes();

Route::view('/', 'welcome')->middleware('guest');

Route::view('/home', 'HomeController@index')->name('home')->middleware('auth');
