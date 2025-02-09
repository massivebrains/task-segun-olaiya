<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Tasks\DeleteTaskController;
use App\Http\Controllers\Tasks\GetTasksController;
use App\Http\Controllers\Tasks\SaveTaskController;
use App\Http\Controllers\Tasks\UpdatePrioritiesController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect('/register');
});

Route::get('/dashboard', GetTasksController::class)->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::post('/task', SaveTaskController::class)->name('task.save');
    Route::delete('/task', DeleteTaskController::class)->name('task.destroy');
    Route::patch('/tasks/update-priorities', UpdatePrioritiesController::class)->name('tasks.update.priorities');
});

require __DIR__.'/auth.php';
