<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\FlowerController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:api');

// Route::apiResource('flowers', FlowerController::class);

Route::resource('flower', FlowerController::class,
    [
        'only'=>[
            'index',
            'show'
        ]
    ]
        );

Route::resource('flower', FlowerController::class,
    [
        'except'=>[
            'index',
            'show'
        ]
    ])->middleware(['auth:api']);
        