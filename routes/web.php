<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\ProjectController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});


Route::middleware('islogin')->group(function () {
    // projects 
    Route::get('/projects', [ProjectController::class, 'index'])->name('projects.index');

    // tasks
    Route::get('/tasks/submit/{id}', [TaskController::class, 'submit'])->name('task.submit');
    Route::post('/tasks/handlesubmit/{id}', [TaskController::class, 'handleSubmit'])->name('task.handleSubmit');

    //logout
    Route::get('/logout', [AuthController::class, 'logout'])->name('auth.logout');
});


Route::middleware('isadmin')->group(function () {
    //projects
    Route::get('/projects/create', [ProjectController::class, 'create'])->name('projects.create');
    Route::post('/projects/store', [ProjectController::class, 'store'])->name('projects.store');
    Route::get('/projects/show/{id}', [ProjectController::class, 'show'])->name('projects.show');
    Route::get('/projects/edit/{id}', [ProjectController::class, 'edit'])->name('projects.edit');
    Route::post('/projects/update/{id}', [ProjectController::class, 'update'])->name('projects.update');
    Route::get('/projects/delete/{id}', [ProjectController::class, 'delete'])->name('projects.delete');
    //task
    Route::post('/tasks/store', [TaskController::class, 'store'])->name('task.store');
    Route::get('/tasks/edit/{id}', [TaskController::class, 'edit'])->name('tasks.edit');
    Route::post('/tasks/update/{id}', [TaskController::class, 'update'])->name('task.update');
});



//login
Route::get('/login', [AuthController::class, 'login'])->name('auth.login');
Route::post('/hlogin', [AuthController::class, 'hLogin'])->name('auth.hlogin');
