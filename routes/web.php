<?php

use Illuminate\Support\Facades\Route;
Route::get('/', function () {
    return view('dashboard');
});
Route::get('/conductor', function () {
    return view('vista_conductor.index');
});
Route::get('/conductor/create', function () {
    return view('vista_conductor.create');
});

