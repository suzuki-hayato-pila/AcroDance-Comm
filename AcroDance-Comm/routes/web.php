<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;

// ホームページ
Route::get('/', function () {
    return view('home');
})->name('home');

// ダッシュボード
Route::get('/dashboard', function () {
    return redirect()->route('home')->with('status', 'ログインが完了しました。');
})->middleware(['auth', 'verified'])->name('dashboard');

// プロフィール関連
Route::middleware('auth')->prefix('profile')->name('profile.')->group(function () {
    Route::get('/', [ProfileController::class, 'edit'])->name('edit');
    Route::patch('/', [ProfileController::class, 'update'])->name('update');
    Route::delete('/', [ProfileController::class, 'destroy'])->name('destroy');
    Route::get('/edit-bio', [ProfileController::class, 'editBio'])->name('edit_bio');
    Route::patch('/update-bio', [ProfileController::class, 'updateBio'])->name('update_bio');
});

// 認証関連
Route::post('/login', [AuthController::class, 'login'])->name('login');

// 投稿関連
Route::middleware('auth')->prefix('posts')->name('posts.')->group(function () {
    Route::get('/', [PostController::class, 'index'])->name('index');
    Route::get('/create', [PostController::class, 'create'])->name('create');
    Route::post('/', [PostController::class, 'store'])->name('store');
    Route::get('/{id}', [PostController::class, 'show'])->name('show');
    Route::get('/{id}/edit', [PostController::class, 'edit'])->name('edit'); // 編集
    Route::put('/{id}', [PostController::class, 'update'])->name('update'); // 更新
    Route::delete('/{id}', [PostController::class, 'destroy'])->name('destroy'); // 削除
});

// 検索機能
Route::get('/search', function () {
    return view('search.search');
})->name('search');

// 認証に関するルート
require __DIR__ . '/auth.php';
