<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\NoteBookController;

Route::get('/v1/notebook/', [NoteBookController::class, 'index']);
Route::post('/v1/notebook/', [NoteBookController::class, 'store']);
Route::get('/v1/notebook/{id}', [NoteBookController::class, 'show']);
Route::post('/v1/notebook/{id}/', [NoteBookController::class, 'update']);
Route::delete('/v1/notebook/{id}', [NoteBookController::class, 'destroy']);
