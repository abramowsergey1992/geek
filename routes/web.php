<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\StudentController;

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


Route::get('/reload', function () {
     Artisan::call('migrate:refresh --seed');
    echo "База пересоздана успешно";
})->name('about');
Route::get('/about', function () {
    return view('about');
})->name('about');
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::resource('students', StudentController::class);


// Route::get('/students', [ProfileController::class, 'index'])->name('profile.index');
// Route::get('/students/create', [ProfileController::class, 'create'])->name('profile.create');
Route::resource('posts', PostController::class); 
 Route::get('/', [PostController::class, 'home'])->name('posts.home');
Route::middleware('auth')->group(function () {

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});




require __DIR__.'/auth.php';
