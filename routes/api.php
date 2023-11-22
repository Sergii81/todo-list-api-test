<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\StatusController;
use App\Http\Controllers\TaskController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

/*Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});*/

Route::prefix('v1')->group(function () {
    Route::post('/login', [LoginController::class, 'loginUser']);

    Route::middleware('auth:sanctum')->group(function () {
        Route::controller(TaskController::class)->prefix('tasks')->group(function () {
            Route::get('/', 'index');
            Route::post('/', 'create');
            Route::get('/{task}', 'show');
            Route::patch('/{task}', 'update');
            Route::delete('/delete/{task}', 'delete');
        });
        Route::controller(StatusController::class)->prefix('statuses')->group(function () {
            Route::get('/', 'index');
        });
    });
});
