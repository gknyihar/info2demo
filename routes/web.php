<?php

use App\Http\Controllers\TaskController;
use App\Http\Controllers\TaskStatusController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::view('/', 'index')->name('index');

Route::get('/users', [UserController::class, 'index'])->name('users');

Route::get('/users/{user}/tasks', [TaskController::class, 'index'])->name('tasks.index');
Route::post('/users/{user}/tasks', [TaskController::class, 'store'])->name('tasks.create');

Route::delete('/tasks/{task}', [TaskController::class, 'destroy'])->name('tasks.delete');

Route::patch('/tasks/{task}/done', [TaskStatusController::class, 'statusDone'])->name('tasks.status.done');
Route::patch('/tasks/{task}/in_progress', [TaskStatusController::class, 'statusInProgress'])->name('tasks.status.in_progress');

Route::get('/tasks/{task}/edit', [TaskController::class, 'edit'])->name('tasks.edit');
Route::put('/tasks/{task}/edit', [TaskController::class, 'update'])->name('tasks.update');
