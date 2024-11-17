<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AuthController; // AuthController をインポート
use Illuminate\Support\Facades\Route;

// ホーム画面ルート
Route::get('/', function () {
    return view('welcome');
});

// ダッシュボードルート
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// プロフィール関連ルート
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// ログイン関連のルート
Route::post('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

require __DIR__.'/auth.php';
