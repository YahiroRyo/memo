<?php

use App\Http\Controllers\NoteController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->prefix('/')->group(function () {
    Route::prefix('/notes')->group(function () {
        Route::get('/', [NoteController::class, 'noteList']);
        Route::post('/', [NoteController::class, 'registerNote']);
        Route::put('/', [NoteController::class, 'editNote']);
        Route::delete('/', [NoteController::class, 'deleteNote']);
    });
});
