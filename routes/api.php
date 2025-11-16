<?php

use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::post('/users', [UserController::class, 'store']);
Route::post('/login', [UserController::class, 'login']);
Route::get('/user', [UserController::class, 'show']);
Route::put('/user', [UserController::class, 'update']);
Route::delete('/user', [UserController::class, 'destroy']);
Route::post('/user/upload-profile', [UserController::class, 'uploadProfilePicture']);
Route::put('/user/change-password', [UserController::class, 'changePassword']);
Route::post('/logout', [UserController::class, 'logout']);
Route::get('/users', [UserController::class, 'index']);
Route::get('/users/{id}', [UserController::class, 'view']);
Route::delete('/users/{id}', [UserController::class, 'delete']);