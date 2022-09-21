<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApiAuthController;
use App\Http\Controllers\ApiProjectController;
use App\Http\Controllers\ApiTaskController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});



Route::middleware('isApiUser')->group(function () {
    // task api 
    Route::get('/tasks', [ApiTaskController::class, 'index']);
    Route::post('/tasks/store', [ApiTaskController::class, 'store']);
    Route::post('/tasks/update/{id}', [ApiTaskController::class, 'update']);
    Route::post('/tasks/handlesubmit/{id}', [ApiTaskController::class, 'handleSubmit']);
});

Route::middleware('isApiAdmin')->group(function () {
    // project api 
    Route::get('/projects', [ApiProjectController::class, 'index']);
    Route::get('/projects/show/{id}', [ApiProjectController::class, 'show']);
    Route::post('/projects/store', [ApiProjectController::class, 'store']);
    Route::post('/projects/update/{id}', [ApiProjectController::class, 'update']);
    Route::get('/projects/delete/{id}', [ApiProjectController::class, 'delete']);
});

// login/register
Route::post('/hlogin', [ApiAuthController::class, 'hLogin']);
Route::post('/logout', [ApiAuthController::class, 'hLogout']);
