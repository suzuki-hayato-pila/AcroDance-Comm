<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;

// トップ画面ルート（ログイン状態に応じた表示）
Route::get('/', function () {
    return view('home');
})->name('home');

// ログイン後のリダイレクト先を home に変更
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', function () {
        return redirect()->route('home')->with('status', 'ログインが完了しました。');
    })->name('dashboard');
});

// プロフィール関連ルート
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/profile/edit-bio', [ProfileController::class, 'editBio'])->name('profile.edit_bio');
    Route::patch('/profile/update-bio', [ProfileController::class, 'updateBio'])->name('profile.update_bio'); // PATCHルートの確認
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
    Route::post('/posts/location', [PostController::class, 'setLocation'])->name('posts.location.set');
});

// 投稿詳細ページのルート
Route::get('/posts/{post}', [PostController::class, 'show'])->name('posts.show');

// 検索ページの仮ルート
Route::get('/search', function () {
    return view('search.search');
})->name('search');

require __DIR__.'/auth.php';
