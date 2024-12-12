<?php

namespace App\Http\Controllers\Auth;

use Laravel\Socialite\Facades\Socialite; // Socialiteを使うためにインポート
use Illuminate\Http\Request;
use App\Models\User; // ユーザー情報を扱うためにモデルをインポート
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth; // ログイン機能に必要

class GoogleController extends Controller
{
    // Googleログイン画面へのリダイレクト
    public function redirectToGoogle()
    {
                // 環境変数の値を確認
        dd([
            'GOOGLE_CLIENT_ID' => env('GOOGLE_CLIENT_ID'),
            'GOOGLE_CLIENT_SECRET' => env('GOOGLE_CLIENT_SECRET'),
            'GOOGLE_REDIRECT_URL' => env('GOOGLE_REDIRECT_URL'),
        ]);

        return Socialite::driver('google')->redirect();
    }

    // Googleからのコールバックを処理
    public function handleGoogleCallback()
    {
        try {
            // Googleからユーザー情報を取得
            $googleUser = Socialite::driver('google')->stateless()->user();

            // データベースで該当のGoogleユーザーを検索
            $user = User::where('email', $googleUser->getEmail())->first();

            // 初めてのログインなら新しいユーザーを作成
            if (!$user) {
                $user = User::create([
                    'name' => $googleUser->getName(),
                    'email' => $googleUser->getEmail(),
                    'password' => bcrypt('password'), // 仮のパスワードを設定
                ]);
            }

            // ユーザーをログイン状態にする
            Auth::login($user);

            // ダッシュボードや任意のページにリダイレクト
            return redirect('/dashboard');
        } catch (\Exception $e) {
            // エラーが発生した場合はログインページに戻す
            return redirect('/login')->withErrors(['msg' => 'Googleログインに失敗しました']);
        }
    }
}
