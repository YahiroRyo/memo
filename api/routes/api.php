<?php

use App\Http\Controllers\NoteController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->prefix('/')->group(function () {
    Route::prefix('/notes')->group(function () {
        Route::get('/', [NoteController::class, 'noteList']);
        Route::post('/', [NoteController::class, 'registerNote']);
        Route::delete('/', [NoteController::class, 'deleteNote']);
        Route::prefix('/{noteId}')->group(function () {
            Route::put('/title', [NoteController::class, 'editNoteTitle']);
            Route::get('/', [NoteController::class, 'note']);
            Route::put('/', [NoteController::class, 'editNote']);
        });
    });
});
