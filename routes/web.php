<?php

use App\Http\Controllers\MainController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProjectController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MainController2;
use App\Http\Controllers\AlumnoController;
use App\Http\Controllers\LanguageController;


Route::get("main", MainController::class);

Route::resource("alumnos", AlumnoController::class)
->middleware('auth');


Route::view("/","welcome")->name("home");

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::resource('projects', ProjectController::class);
    Route::post('/projects/{project}/assign-students', [ProjectController::class, 'assignStudents'])
        ->name('projects.assign-students');
    Route::delete('/projects/{project}/remove-student/{alumno}', [ProjectController::class, 'removeStudentFromProject'])
        ->name('projects.remove-student');
});
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::resource('projects', ProjectController::class);
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get("language/{locale}", LanguageController::class)->name('language');
require __DIR__.'/auth.php';
