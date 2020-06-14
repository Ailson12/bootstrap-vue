<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('home', function () {
    return view("admin.home");
});

Route::resource('admin/lanche', 'LancheController');
Route::resource('admin/bebida', 'BebidaController');

Route::resource('user', 'UserController');