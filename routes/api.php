<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;

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

Route::post('login', [StudentController::class, 'api_login']);
Route::get('/students/{id}', [StudentController::class, 'api_show']);
Route::middleware('auth:sanctum')->post('/students/create', [StudentController::class, 'api_create']);
Route::middleware('auth:sanctum')->delete('/students/{id}', [StudentController::class, 'api_delete']);
Route::middleware('auth:sanctum')->put('/students/{id}', [StudentController::class, 'api_update']);
Route::get('/students', [StudentController::class, 'api_index']);

Route::get('/posts/{id}', [PostController::class, 'api_show']);
Route::middleware('auth:sanctum')->post('/posts/create', [PostController::class, 'api_create']);
Route::middleware('auth:sanctum')->delete('/posts/{id}', [PostController::class, 'api_delete']);
Route::middleware('auth:sanctum')->put('/posts/{id}', [PostController::class, 'api_update']);
Route::get('/posts', [PostController::class, 'api_index']);


Route::get('/post/{id}', [PostController::class, 'getPost'])->name('post.getPost');

// Route::get('/students/get/{id}', [PostController::class, 'get'])->name('students.geнХ');
Route::middleware('auth:sanctum')->get('/get-user', [StudentController::class, 'getUser']);
Route::get('/posts', [PostController::class, 'apiIndex'])->name('posts.get');
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
