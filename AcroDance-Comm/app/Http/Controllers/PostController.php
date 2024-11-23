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
        'preferred_gender' => 'nullable|string',
        'preferred_group_size' => 'nullable|string',
    ]);

    Post::create([
        'title' => $request->title,
        'content' => $request->content,
        'preferred_gender' => $request->preferred_gender,
        'preferred_group_size' => $request->preferred_group_size,
        'user_id' => Auth::id(),
    ]);

    return redirect()->route('posts.index')->with('success', '投稿が完了しました！');
}

// 投稿画面の活動場所選択画面
    public function locationCreate()
{
    return view('posts.create_location');
}
}
