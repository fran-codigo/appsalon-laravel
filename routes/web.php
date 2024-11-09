<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home.index');
});

Route::get('/{pathMatch}', function () {
    return view('home.index');
})->where('pathMatch', '.*');
