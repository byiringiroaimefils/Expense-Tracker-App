<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\registerController;
use App\Http\Controllers\transactionController;
use App\Http\Controllers\reportController;
use App\Http\Middleware\LoginMiddleware;

// Basic Routes
Route::get('/', function () {
    return view('Auth.login');
})->name('login');

Route::get('/register', function () {
    return view('Auth.register');
})->name('register');

Route::get('/transaction_form', function () {
    return view('Transaction.Add_form');
});

// user authontication
Route::post('/register', [registerController::class, 'register'])->name('register.store');
Route::post('/login', [registerController::class, 'login'])->name('register.login');
Route::get('/dashboard', [registerController::class, 'dashboard'])->name('dashboard')->middleware('App\Http\Middleware\LoginMiddleware');
Route::get('/logout', [registerController::class, 'logout'])->name('register.logout')->middleware('App\Http\Middleware\LoginMiddleware');

// Transaction routes
Route::get('/transaction', [transactionController::class, 'index'])->name('transaction')->middleware('App\Http\Middleware\LoginMiddleware');
Route::post('/transaction', [transactionController::class, 'store'])->name('transaction.store')->middleware('App\Http\Middleware\LoginMiddleware');
Route::get('/edit_transaction/{id}', [transactionController::class, 'edit'])->name('transaction.edit')->middleware('App\Http\Middleware\LoginMiddleware');
Route::put('/update_transaction/{id}', [transactionController::class, 'update'])->name('transaction.update')->middleware('App\Http\Middleware\LoginMiddleware');
Route::delete('/delete_transaction/{id}', [transactionController::class, 'delete'])->name('transaction.delete')->middleware('App\Http\Middleware\LoginMiddleware');

//Report Routes
Route::get('/report', [reportController::class, 'index'])->name('report')->middleware('App\Http\Middleware\LoginMiddleware');



