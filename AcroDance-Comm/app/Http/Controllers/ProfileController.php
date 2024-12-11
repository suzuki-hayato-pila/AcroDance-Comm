<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Models\Post; //モデルのインポート
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        // return view('profile.edit', [
        //     'user' => $request->user(),
        // ]);
        $user = $request->user();
        // $posts = Post::where('user_id', $user->id)->get(); // ログインユーザーの投稿を取得
        $posts = Post::where('user_id', $user->id)->paginate(5); // ページネーションで5件取得

        return view('profile.edit', compact('user', 'posts')); // ビューに渡す

    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }

    /**
     * Show the edit bio form.
     */
    public function editBio(Request $request): View
    {
        return view('profile.edit_bio', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's bio.
     */
    public function updateBio(Request $request): RedirectResponse
    {
        $request->validate([
            'bio' => 'nullable|string|max:1000', // 自己紹介のバリデーション
        ]);

        // デバッグログ: リクエスト内容と現在のbio
        logger()->info('Request Data: ', ['bio' => $request->input('bio')]);
        logger()->info('Before Update Bio: ', ['bio' => $request->user()->bio]);

        // bioのデータベース更新
        $request->user()->update([
            'bio' => $request->input('bio'),
        ]);

        // デバッグログ: 更新後のbio
        logger()->info('After Update Bio: ', ['bio' => $request->user()->bio]);

        return redirect()->route('profile.edit')->with('status', '自己紹介を更新しました。');
    }


}
