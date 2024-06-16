<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;


use App\Http\Controllers\RecordController;
use App\Http\Controllers\ProjectController;

Route::get('/welcome', function () {
    return view('welcome');
});

Route::post('/api/save-record', [RecordController::class, 'saveRecord']);

// Trasa do tworzenia projektu
Route::get('/projects/create', [ProjectController::class, 'create'])->middleware('auth')->name('projects.create');
Route::post('/projects', [ProjectController::class, 'store'])->middleware('auth')->name('projects.store');

// Trasa do wyświetlania kodu snippetu dla projektu
Route::get('/project/{id}/snippet', [ProjectController::class, 'showSnippet'])->name('project.snippet');


Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

