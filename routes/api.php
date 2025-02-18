<?php

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

