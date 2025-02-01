<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\TasksController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::post('/register', [AuthController::class, 'register'])->middleware('guest:sanctum');
Route::post('/login', [AuthController::class, 'login'])->middleware('guest:sanctum');

Route::middleware('auth:sanctum')->group(function() {
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::apiResource('/tasks', TasksController::class);
});
