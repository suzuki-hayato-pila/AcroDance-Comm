<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AuthController; // AuthController をインポート
use App\Http\Controllers\PostController; // PostController　をインポート
use Illuminate\Support\Facades\Route;

// ホーム画面ルート
// Route::get('/', function () {
// return view('welcome');
// });

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
Route::post('/posts/location', [PostController::class, 'setLocation'])->name('posts.location.set');
});

// 投稿詳細ページのルート
Route::get('/posts/{post}', [PostController::class, 'show'])->name('posts.show');


// トップ画面ルート
Route::get('/', function () {
    return view('home');
})->name('home');

// 検索ページの仮ルート
Route::get('/search', function () {
    return view('search.search'); // 後で本物の検索ビューを作成
})->name('search');






require __DIR__.'/auth.php';
