<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\MapInfo; // MapInfo モデルをインポート
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
        logger()->info('セッションの全データ: ', session()->all());
        return view('posts.create');
    }

    // 投稿を保存
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'location_name' => 'nullable|string|max:255',
            'preferred_gender' => 'nullable|string',
            'preferred_group_size' => 'nullable|string',
        ]);

        Post::create([
            'title' => $request->title,
            'content' => $request->content,
            'location_name' => session('selectedLocation'),
            'preferred_gender' => $request->preferred_gender,
            'preferred_group_size' => $request->preferred_group_size,
            'user_id' => Auth::id(),
        ]);

        logger()->info('保存された投稿: ', [
            'title' => $request->title,
            'content' => $request->content,
            'location_name' => session('selectedLocation'),
        ]);

        return redirect()->route('posts.index')->with('success', '投稿が完了しました！');
    }

    // 投稿画面の活動場所選択画面
    public function locationCreate()
    {
        $selectedLocation = session('selectedLocation', null);
        logger()->info('セッションの全データ: ', session()->all());
        return view('posts.create_location', compact('selectedLocation'));
    }

    // 活動場所をセッションに保存
    public function setLocation(Request $request)
    {
        $request->validate([
            'location_name' => 'required|string|max:255',
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
        ]);

        // デバッグ用ログ
        logger()->info('受信したリクエストデータ: ', $request->all());

        // データベースに保存
        MapInfo::create([
            'activity_location' => $request->location_name,
            'latitude' => $request->latitude,
            'longitude' => $request->longitude,
            'post_id' => Auth::id(),
        ]);

        // セッションに保存
        session([
            'selectedLocation' => $request->location_name,
        ]);

        // セッション保存後の状態をログに記録
        logger()->info('セッション保存後: ', session()->all());

        return redirect()->route('posts.create')->with('success', '活動場所が保存されました！');
    }

    // 投稿詳細を表示
    public function show($id)
    {
        $post = Post::findOrFail($id); // 投稿を取得
        $mapInfo = $post->mapInfo;    // MapInfoとのリレーションを使用

        return view('posts.show', compact('post', 'mapInfo'));
    }
}
