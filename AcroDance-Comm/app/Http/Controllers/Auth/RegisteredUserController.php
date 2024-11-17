<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        // リクエスト内容を確認
        // dd($request->all());

        // バリデーション
        $request->validate([
            'account_name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'instagram' => 'nullable|string|max:255',
            // 'gender' => 'required|string',
            'gender' => 'required|in:male,female',
            'location' => 'nullable|string|max:255',
            'profile_photo' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        // プロフィール写真の保存処理
        $profilePhotoPath = null;
        if ($request->hasFile('profile_photo')) {
            $profilePhotoPath = $request->file('profile_photo')->store('profile_photos', 'public');
        }

        // ユーザー作成
        $user = User::create([
            'account_name' => $request->account_name,
            'name' => $request->account_name, // ここで `name` を設定
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'instagram' => $request->instagram,
            'gender' => $request->gender, //この部分は正しい。
            'location' => $request->location,
            'profile_photo' => $profilePhotoPath,
        ]);

        // 登録イベント発火
        event(new Registered($user));

        // ログイン処理
        Auth::login($user);

        // ダッシュボードへのリダイレクト
        return redirect()->route('dashboard');
    }
}
