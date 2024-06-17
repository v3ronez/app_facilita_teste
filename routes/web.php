<?php

use App\Http\Controllers\BookController;
use App\Http\Controllers\LoanController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified', 'redirect_to_profile'])->name('dashboard');


//user-default
Route::middleware(['auth'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');

    Route::get('/user/{id}', [UserController::class, 'show'])->name('user.show');
    Route::put('/user/{id}', [UserController::class, 'update'])->name('user.update');
});


//admin
Route::middleware(['auth', 'admin'])->prefix('admin')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('admin.profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('admin.profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    //user
    Route::get('/users', [UserController::class, 'index'])->name('admin.user.index');
    Route::get('/user/{id}', [UserController::class, 'show'])->name('admin.user.show');
    Route::put('/user/{id}', [UserController::class, 'update'])->name('admin.user.update');
    Route::delete('/user/{id}', [UserController::class, 'destroy'])->name('admin.user.delete');

    //book
    Route::get('/books', [BookController::class, 'index'])->name('admin.book.index');
    Route::get('/book/new', [BookController::class, 'create'])->name('admin.book.create');
    Route::post('/book', [BookController::class, 'store'])->name('admin.book.store');
    Route::get('/book/{id}', [BookController::class, 'show'])->name('admin.book.show');
    Route::put('/book/{id}', [BookController::class, 'update'])->name('admin.book.update');

    //loan
    Route::get('/loans', [LoanController::class, 'index'])->name('admin.loan.index');
    Route::post('/loan/{id}', [LoanController::class, 'store'])->name('admin.loan.store');
    Route::put('/loan/status/{id}', [LoanController::class, 'update'])->name('admin.loan.update');
});

require __DIR__.'/auth.php';
