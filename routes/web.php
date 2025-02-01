<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\TasksController;
use App\Http\Controllers\Auth\AuthController;


Route::get('/', function () {
    return view('auth.register'); 
});

Route::get('/login', function () {
    return view('auth.login'); 
})->name('login');

Route::post('/register', [AuthController::class, 'register']); 
Route::post('/login', [AuthController::class, 'login'])->name('login'); 

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/tasks', [TasksController::class, 'index'])->name('tasks');
    Route::get('/tasks/create', [TasksController::class, 'create']);
    Route::post('/tasks', [TasksController::class, 'store']);
    Route::patch('/tasks/{id}', [TasksController::class, 'update']);
    Route::delete('/tasks/{id}', [TasksController::class, 'delete']);

    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});
