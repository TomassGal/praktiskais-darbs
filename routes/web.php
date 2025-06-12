<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use App\Http\Controllers\AuctionController;
use App\Http\Controllers\BidController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Log;



Route::resource('auction', AuctionController::class);
Route::get('/auctions/{id}' , [AuctionController::class, 'personalIndex'])->name('auction.personal');
Route::get('/auctions' , [AuctionController::class, 'sort'])->name('auction.sort');


Route::resource('auctions.bid', BidController::class);

Route::resource('user', UserController::class);
Route::put('/user/{id}/block', [UserController::class, 'block'])->name('user.block');
Route::put('/user/{id}/unblock', [UserController::class, 'unBlock'])->name('user.unBlock');
Route::put('/user/{id}/admin', [UserController::class, 'makeAdmin'])->name('user.makeAdmin');

Route::middleware('guest')->get('/login', [AuthController::class, 'showLogin'])->name('auth.login');
Route::middleware('guest')->post('/login', [AuthController::class, 'login']);
Route::middleware('guest')->get('/register', [AuthController::class, 'showRegister'])->name('auth.register');
Route::middleware('guest')->post('/register', [AuthController::class, 'register']);
Route::middleware('auth')->get('/logout', [AuthController::class, 'logout'])->name('auth.logout');

Route::middleware(['web'])->get('/lang/{locale}', function ($locale) {
    app()->setLocale($locale);
    session()->put('locale', $locale);
    logger('Stored in session (accessed by route): ' . session('locale'));
    return redirect()->route('auction.index');
})->name('lang.switch');

Route::get('/', function () {
    return redirect()->route('auction.index');
});