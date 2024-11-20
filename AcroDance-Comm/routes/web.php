<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AuthController; // AuthController をインポート
use App\Http\Controllers\PostController; // PostController　をインポート
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

// 投稿関連のルート
Route::middleware(['auth'])->group(function () {
    Route::get('/posts', [PostController::class, 'index'])->name('posts.index');
    Route::get('/posts/create', [PostController::class, 'create'])->name('posts.create');
    Route::post('/posts', [PostController::class, 'store'])->name('posts.store');
    Route::get('/posts/location', [PostController::class, 'locationCreate'])->name('posts.location.create');

});


require __DIR__.'/auth.php';
