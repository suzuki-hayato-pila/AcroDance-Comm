<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    // 投稿一覧を表示
    public function index()
    {
        $posts = Post::orderBy('id', 'desc')->get(); // id カラムで並び替え
        return view('posts.index', compact('posts'));
    }

    // 投稿フォームを表示
    public function create()
    {
        return view('posts.create');
    }

    // 投稿を保存
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'location_name' => 'nullable|string|max:255', // 追加
            'preferred_gender' => 'nullable|string',
            'preferred_group_size' => 'nullable|string',
        ]);

        Post::create([
            'title' => $request->title,
            'content' => $request->content,
            'location_name' => $request->location_name, // 追加
            'preferred_gender' => $request->preferred_gender,
            'preferred_group_size' => $request->preferred_group_size,
            'user_id' => Auth::id(),
        ]);

        return redirect()->route('posts.index')->with('success', '投稿が完了しました！');
    }

    // 投稿画面の活動場所選択画面
    public function locationCreate()
    {
        $selectedLocation = session('selectedLocation', null); // セッションから活動場所を取得
        return view('posts.create_location', compact('selectedLocation'));
    }

    // 活動場所をセッションに保存
    public function setLocation(Request $request)
    {
        $request->validate([
            'location_name' => 'required|string|max:255', // 活動場所名のバリデーション
        ]);

        session(['selectedLocation' => $request->location_name]); // セッションに保存

        return redirect()->route('posts.create'); // 投稿画面にリダイレクト
    }

    // 投稿詳細を表示
    public function show($id)
    {
        $post = Post::findOrFail($id); // IDで投稿を取得
        return view('posts.show', compact('post')); // show.blade.phpを表示
    }
}
