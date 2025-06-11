<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuctionController;
use App\Http\Controllers\AuthController;

Route::resource('auction', AuctionController::class);


Route::middleware('guest')->get('/login', [AuthController::class, 'showLogin'])->name('auth.login');
Route::middleware('guest')->post('/login', [AuthController::class, 'login']);
Route::middleware('guest')->get('/register', [AuthController::class, 'showRegister'])->name('auth.register');
Route::middleware('guest')->post('/register', [AuthController::class, 'register']);
Route::middleware('auth')->get('/logout', [AuthController::class, 'logout'])->name('auth.logout');

Route::get('/', function () {
    return redirect()->route('auction.index');
});