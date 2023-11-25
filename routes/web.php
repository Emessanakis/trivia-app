<?php

use App\Http\Controllers\SearchFormController;
use Illuminate\Support\Facades\Route;

Route::get('/', [SearchFormController::class, 'index'])->name("search-form.index");
Route::post('/trivia-questions/process', [SearchFormController::class, 'processForm'])->name('trivia-questions.process');