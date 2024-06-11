<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;

Route::get('/', function () { 
    return view('pages.home');
})->name('home');

Route::get('/flower', function () {
    return view('pages.plp');
})->name('plp');

Route::get('/flower/{i}', function () {
    return view('pages.pdp');
})->name('pdp');