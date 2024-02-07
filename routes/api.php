<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\StudentController;
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
Route::get('/students/get/{id}', [StudentController::class, 'get'])->name('students.get');
Route::get('/posts', [PostController::class, 'apiIndex'])->name('posts.get');
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
