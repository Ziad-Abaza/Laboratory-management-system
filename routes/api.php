<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Api\UserController;
use Illuminate\Session\Middleware\StartSession;


/*
|-------------------------------------------
|> API Authentication Routes
|-------------------------------------------
*/
Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/login', [AuthController::class, 'login'])->middleware('throttle:5,1');

Route::middleware(['auth:sanctum', StartSession::class])->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);
});

/*
|-------------------------------------------
|> API Authentication Routes
|-------------------------------------------
*/
Route::prefix('users')->group(function () {
    Route::get('/', [UserController::class, 'index']);
    Route::get('{id}', [UserController::class, 'show']);
    Route::post('/', [UserController::class, 'store']);
    Route::put('{id}', [UserController::class, 'update']);
    Route::delete('{id}', [UserController::class, 'destroy']);
    Route::patch('{id}/status', [UserController::class, 'toggleStatus']);
})->middleware('checkRole:Admin');

