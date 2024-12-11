<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\MapInfo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class PostController extends Controller
{
    // 投稿一覧を表示
    public function index()
    {
        // return view('コメント');
        // $posts = Post::orderBy('id', 'desc')->get(); // id カラムで並び替え
        // // ページネーションを適用（1ページあたり10件のデータ）
        $posts = Post::orderBy('id', 'desc')->paginate(10);
        // $posts = Post::with('mapInfo')->orderBy('id', 'desc')->paginate(10);
        // $posts = MapInfo::orderBy('post_id', 'desc')->get();

        // // デバッグログで確認
        // Log::info('Index method with pagination', ['page' => request('page', 1), 'total' => $posts->total()]);
        // Log::info('Posts fetched successfully', ['posts' => $posts->toArray()]);
        // Log::info('Index method: Fetched posts', ['posts' => $posts->toArray()]);

        // return view('posts.index', compact('posts'));
        // Log::info('Index method: Start fetching posts');
        // try {
        //     $posts = Post::orderBy('id', 'desc')->paginate(10);
        //     Log::info('Index method: Posts fetched successfully');
            return view('posts.index', compact('posts'));
        // } catch (\Exception $e) {
        //     Log::error('Error in posts.index view: ' . $e->getMessage());
        //     return "Error: " . $e->getMessage();
        // }
        // $posts = Post::orderBy('id', 'desc')->paginate(10);
        // dd($posts->items()); // ページ内のアイテムのみダンプ
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
        Log::info('Request Data: ', $request->all());

        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'location_name' => 'required|string|max:255',
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
            'preferred_gender' => 'nullable|string',
            'preferred_group_size' => 'nullable|string',
        ]);

        try {
            // 投稿データを作成
            $post = Post::create([
                'title' => $request->title,
                'content' => $request->content,
                'location_name' => $request->location_name,
                'preferred_gender' => $request->preferred_gender,
                'preferred_group_size' => $request->preferred_group_size,
                'user_id' => Auth::id(),
            ]);

            // 関連する地図情報を作成
            MapInfo::create([
                'activity_location' => $request->location_name,
                'latitude' => $request->latitude,
                'longitude' => $request->longitude,
                'post_id' => $post->id,
            ]);

            // セッションに保存
            session([
                'selectedLocation' => $request->location_name,
            ]);

            Log::info('Post created successfully', ['post_id' => $post->id]);

            return redirect()->route('posts.index')->with('success', '投稿が完了しました！');
        } catch (\Exception $e) {
            Log::error('Error while storing post: ' . $e->getMessage());

            // ユーザーへのフィードバック
            return redirect()
                ->route('posts.create')
                ->withErrors(['error' => '投稿の保存中にエラーが発生しました。再度お試しください。']);
        }
    }

    // 投稿詳細画面
    public function show($id)
    {
        try {
            $post = Post::with('mapInfo')->findOrFail($id);
        } catch (\Exception $e) {
            Log::error('Post not found: ' . $e->getMessage());
            return redirect()->route('posts.index')->withErrors(['error' => '指定された投稿が見つかりません。']);
        }

        return view('posts.show', compact('post'));
    }

}





    // public function index()
    // {
    //     $posts = Post::with(['mapInfo:id,post_id,activity_location,latitude,longitude'])
    //         ->orderBy('id', 'desc')
    //         ->get();
    //     return view('posts.index', compact('posts'));
    // }

        // $request->validate([
        //     'title' => 'required|string|max:255',
        //     'content' => 'required|string',
        //     'location_name' => 'required|string|max:255',
        //     'latitude' => 'required|numeric',
        //     'longitude' => 'required|numeric',
        //     'preferred_gender' => 'nullable|string',
        //     'preferred_group_size' => 'nullable|string',
        // ], [
        //     'title.required' => 'タイトルは必須です。',
        //     'content.required' => '内容は必須です。',
        //     'location_name.required' => '活動場所は必須です。',
        //     'latitude.required' => '緯度が見つかりません。',
        //     'longitude.required' => '経度が見つかりません。',
        // ]);

        // DB::beginTransaction();
        // try {
        //     $post = Post::create([
        //         'title' => $request->title,
        //         'content' => $request->content,
        //         'location_name' => $request->location_name,
        //         'preferred_gender' => $request->preferred_gender,
        //         'preferred_group_size' => $request->preferred_group_size,
        //         'user_id' => Auth::id(),
        //     ]);

        //     MapInfo::create([
        //         'activity_location' => $request->location_name,
        //         'latitude' => $request->latitude,
        //         'longitude' => $request->longitude,
        //         'post_id' => $post->id,
        //     ]);

        //     DB::commit();
        //     Log::info('Post created successfully', ['post_id' => $post->id]);
        // } catch (\Exception $e) {
        //     DB::rollBack();
        //     Log::error('Error while creating post: ' . $e->getMessage());
        //     return redirect()->back()->withErrors(['error' => '投稿の保存中に問題が発生しました。']);
        // }