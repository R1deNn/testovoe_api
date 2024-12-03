<?php

use App\Models\NoteBook;
use Illuminate\Support\Facades\Route;
use App\Http\Resources\NoteBookResourse;
use \App\Http\Controllers\NoteBookController;

Route::get('/', function () {
    return view('welcome');
});
