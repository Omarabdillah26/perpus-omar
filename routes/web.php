<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Admin\AdminBookController;
use App\Http\Controllers\Admin\AdminCategoryController;

// Public Routes
Route::get('/', [BookController::class , 'index'])->name('home');

// Auth Routes
Route::get('/login', [LoginController::class , 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class , 'login'])->name('login.post');
Route::post('/logout', [LoginController::class , 'logout'])->name('logout');

// Register Routes (For Students)
Route::get('/register', [\App\Http\Controllers\Auth\RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [\App\Http\Controllers\Auth\RegisterController::class, 'register'])->name('register.post');

// Student Routes
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [\App\Http\Controllers\StudentController::class, 'dashboard'])->name('student.dashboard');
    Route::get('/borrow', [\App\Http\Controllers\StudentController::class, 'borrowForm'])->name('student.borrow');
    Route::get('/return', [\App\Http\Controllers\StudentController::class, 'returnForm'])->name('student.return');
    Route::post('/borrow', [\App\Http\Controllers\BorrowingController::class, 'store'])->name('borrow.store');
});

// Admin Routes
Route::middleware(['auth', 'admin'])->prefix('admin')->group(function () {
    Route::get('/dashboard', function () {
            return view('admin.dashboard');
        }
        )->name('admin.dashboard');

        // Resource Routes
        Route::resource('books', AdminBookController::class)->names('admin.books');
        
        // Category Management
        Route::resource('categories', \App\Http\Controllers\Admin\AdminCategoryController::class , ['as' => 'admin']);

        // Transaction Management
        Route::get('/borrowings', [\App\Http\Controllers\Admin\AdminBorrowingController::class , 'index'])->name('admin.borrowings.index');
        Route::post('/borrowings/{borrowing}/return', [\App\Http\Controllers\Admin\AdminBorrowingController::class , 'returnBook'])->name('admin.borrowings.return');

        // Member Management
        Route::get('/members', [\App\Http\Controllers\Admin\AdminMemberController::class, 'index'])->name('admin.members.index');
        Route::delete('/members/{user}', [\App\Http\Controllers\Admin\AdminMemberController::class, 'destroy'])->name('admin.members.destroy');
});
