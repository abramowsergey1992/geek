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
    echo "<b>База пересоздана успешно</b>";
    echo '<br/>';
    $files = glob('storage/images/*');
    foreach ($files as $file) { // iterate files

        if ($file != 'storage/images/a.zip') {
            if (is_file($file)) {
                unlink($file);
            }
        }
    }
    $zip = new ZipArchive;

    // Zip File Name 
    if ($zip->open('storage/images/a.zip') === TRUE) {

        // Unzip Path 
        $zip->extractTo('storage/images/');
        $zip->close();
        echo "<b>Файлы распакованы</b>";
        echo '<br/>';
    } else {
        echo "<b>Ошибка при распаковке/b>";
        echo '<br/>';
    }
});
Route::get('/about', function () {
    return view('about');
})->name('about');
Route::get('/profile',  [StudentController::class, 'profile'])->name('profile');
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::resource('students', StudentController::class);


// Route::get('/students', [ProfileController::class, 'index'])->name('profile.index');
// Route::get('/students/create', [ProfileController::class, 'create'])->name('profile.create');
Route::resource('posts', PostController::class);
Route::get('/', [PostController::class, 'home'])->name('posts.home');
Route::middleware('auth')->group(function () {

    // Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    // Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    // Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});




require __DIR__ . '/auth.php';
