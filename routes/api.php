<?php

use App\Http\Controllers\AuthenticationController;
use App\Http\Controllers\EventController;
use Illuminate\Support\Facades\Route;

// event routes
Route::prefix('events')->group(function(){
    Route::get('/', [EventController::class,'index']);
    Route::get('/{id}', [EventController::class,'show']);
    Route::post('/', [EventController::class,'store']);
    Route::put('/{id}', [EventController::class,'update']);
    Route::delete('/{id}', [EventController::class,'destroy']);
});

// auth routes
Route::prefix('auth')->group(function(){
    Route::post('register', [AuthenticationController::class,'register']);
    Route::post('login', [AuthenticationController::class, 'login']);
    Route::middleware('auth:sanctum')->group(function () {
        Route::get('me', [AuthenticationController::class, 'user']);
        Route::get('logout', [AuthenticationController::class, 'logout']);
    });
});