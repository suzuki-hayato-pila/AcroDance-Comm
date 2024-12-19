<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\MapInfo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;

class PostController extends Controller
{
    // 投稿一覧を表示
    // public function index()
    // {
    //     $posts = Post::orderBy('id', 'desc')->paginate(10);
    //         return view('posts.index', compact('posts'));
    // }

    public function index()
    {
        // 投稿と関連する地図情報を取得
        $posts = Post::with('mapInfo')->orderBy('id', 'desc')->paginate(10);
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
            $post = Post::with('mapInfo','user')->findOrFail($id); //投稿者情報も取得
            // dd($post->mapInfo); // mapInfoが取得できるか確認
        } catch (\Exception $e) {
            Log::error('Post not found: ' . $e->getMessage());
            return redirect()->route('posts.index')->withErrors(['error' => '指定された投稿が見つかりません。']);
        }

        return view('posts.show', compact('post'));
    }

    // 編集、削除機能の処理
    public function edit($id)
    {
        $post = Post::findOrFail($id);

        // 自分の投稿以外は403エラー
        if ($post->user_id !== auth()->id()) {
            abort(403, 'Unauthorized action.');
        }

        return view('posts.edit', compact('post'));
    }


    public function update(Request $request, $id)
    {
        // $post = Post::findOrFail($id);
        $post = Post::with('mapInfo')->findOrFail($id);

        // 自分の投稿以外は403エラー
        if ($post->user_id !== auth()->id()) {
            abort(403, 'Unauthorized action.');
        }

        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'location_name' => 'required|string|max:255',
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
            'preferred_gender' => 'nullable|string',
            'preferred_group_size' => 'nullable|string',
        ]);

        // 投稿データを更新
        $post->update([
            'title' => $request->input('title'),
            'content' => $request->input('content'),
            'location_name' => $request->input('location_name'),
            'preferred_gender' => $request->input('preferred_gender'),
            'preferred_group_size' => $request->input('preferred_group_size'),
        ]);

        // 関連する地図情報を更新
        $mapInfo = $post->mapInfo;
        // dd($mapInfo); // mapInfoがnullの場合、リレーションやデータを確認する必要あり
        if ($mapInfo) {
            $mapInfo->update([
                'activity_location' => $request->input('location_name'),
                'latitude' => $request->input('latitude'),
                'longitude' => $request->input('longitude'),
            ]);
        } else {
            // MapInfoが存在しない場合、新規作成
            MapInfo::create([
                'post_id' => $post->id,
                'activity_location' => $request->input('location_name'),
                'latitude' => $request->input('latitude'),
                'longitude' => $request->input('longitude'),
            ]);
        }

        Log::info('MapInfo updated successfully or created', ['post_id' => $post->id]);

        return redirect()->route('posts.show', $post->id)->with('status', '投稿を更新しました。');
    }



    public function destroy($id)
    {
        $post = Post::findOrFail($id);

        // 自分の投稿以外は403エラー
        if ($post->user_id !== auth()->id()) {
            abort(403, 'Unauthorized action.');
        }

        $post->delete();

        return redirect()->route('posts.index')->with('status', '投稿を削除しました。');
    }


    public function search(Request $request)
    {
        $keyword = $request->input('keyword');

        // クエリビルダーの初期化
        $query = Post::query();

        // キーワード検索がある場合
        if (!empty($keyword)) {
            $query->where('title', 'LIKE', "%{$keyword}%")
                  ->orWhere('content', 'LIKE', "%{$keyword}%")
                  ->orWhere('location_name', 'LIKE', "%{$keyword}%");
        } else {
            // キーワードが空の場合は投稿一覧を取得
            $query->orderBy('id', 'desc');
        }

        // 結果を取得（ページネーション付き）
        $posts = $query->paginate(10);

        return view('search.search', compact('posts', 'keyword'));
    }

}

    // 検索ボックスなし
    // public function search()
    // {
    //     $posts = Post::orderBy('id', 'desc')->paginate(10);
    //     return view('search.search', compact('posts'));
    // }

    // 検索ボックスあり
    // public function search(Request $request)
    // {
    //     $keyword = $request->input('keyword');

    //     // 検索クエリがあればフィルタリング
    //     $query = Post::query();
    //     if (!empty($keyword)) {
    //         $query->where('title', 'LIKE', "%{$keyword}%")
    //             ->orWhere('content', 'LIKE', "%{$keyword}%")
    //             ->orWhere('location_name', 'LIKE', "%{$keyword}%");
    //     }

    //     // 結果を取得（ページネーション付き）
    //     $posts = $query->orderBy('id', 'desc')->paginate(10);

    //     return view('search.search', compact('posts'));
    // }





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


        // public function index()
        // {
            // return view('コメント');
            // $posts = Post::orderBy('id', 'desc')->get(); // id カラムで並び替え
            // // ページネーションを適用（1ページあたり10件のデータ）
            // $posts = Post::orderBy('id', 'desc')->paginate(10);
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
                // return view('posts.index', compact('posts'));
            // } catch (\Exception $e) {
            //     Log::error('Error in posts.index view: ' . $e->getMessage());
            //     return "Error: " . $e->getMessage();
            // }
            // $posts = Post::orderBy('id', 'desc')->paginate(10);
            // dd($posts->items()); // ページ内のアイテムのみダンプ
        // }


                // if ($mapInfo) {
        //     // 手動でフィールドを更新
        //     $mapInfo->activity_location = $request->input('location_name');
        //     $mapInfo->latitude = $request->input('latitude');
        //     $mapInfo->longitude = $request->input('longitude');
        //     $mapInfo->save(); // 明示的に保存
        // } else {
        //     // MapInfoが存在しない場合、新規作成
        //     MapInfo::create([
        //         'post_id' => $post->id,
        //         'activity_location' => $request->input('location_name'),
        //         'latitude' => $request->input('latitude'),
        //         'longitude' => $request->input('longitude'),
        //     ]);
        // }

    // public function update(Request $request, $id)
    // {
    //     // 投稿を取得
    //     $post = Post::with('mapInfo')->findOrFail($id);

    //     // 自分の投稿以外は403エラー
    //     if ($post->user_id !== auth()->id()) {
    //         abort(403, 'Unauthorized action.');
    //     }

    //     // バリデーション
    //     $request->validate([
    //         'title' => 'required|string|max:255',
    //         'content' => 'required|string',
    //         'location_name' => 'required|string|max:255',
    //         'latitude' => 'required|numeric',
    //         'longitude' => 'required|numeric',
    //         'preferred_gender' => 'nullable|string',
    //         'preferred_group_size' => 'nullable|string',
    //     ]);

    //     DB::beginTransaction(); // トランザクション開始

    //     try {
    //         // 投稿データを更新
    //         $post->fill([
    //             'title' => $request->input('title'),
    //             'content' => $request->input('content'),
    //             'location_name' => $request->input('location_name'),
    //             'preferred_gender' => $request->input('preferred_gender'),
    //             'preferred_group_size' => $request->input('preferred_group_size'),
    //         ]);

    //         $post->save(); // 明示的に保存

    //         // 関連する地図情報を更新または作成
    //         if ($post->mapInfo) {
    //             $post->mapInfo->activity_location = $request->input('location_name');
    //             $post->mapInfo->latitude = $request->input('latitude');
    //             $post->mapInfo->longitude = $request->input('longitude');
    //             $post->mapInfo->save(); // 強制的に保存
    //         } else {
    //             MapInfo::create([
    //                 'post_id' => $post->id,
    //                 'activity_location' => $request->input('location_name'),
    //                 'latitude' => $request->input('latitude'),
    //                 'longitude' => $request->input('longitude'),
    //             ]);
    //         }

    //         DB::commit(); // トランザクションをコミット

    //         Log::info('Post and MapInfo updated successfully', ['post_id' => $post->id]);

    //         return redirect()->route('posts.show', $post->id)->with('status', '投稿を更新しました。');
    //     } catch (\Exception $e) {
    //         DB::rollBack(); // トランザクションをロールバック
    //         Log::error('Error updating post or mapInfo: ' . $e->getMessage());

    //         return redirect()->back()->withErrors(['error' => '更新中にエラーが発生しました。']);
    //     }
    // }

        // public function update(Request $request, $id)
    // {
    //     $post = Post::findOrFail($id);

    //     // 自分の投稿以外は403エラー
    //     if ($post->user_id !== auth()->id()) {
    //         abort(403, 'Unauthorized action.');
    //     }

    //     $request->validate([
    //         'title' => 'required|string|max:255',
    //         'content' => 'required|string',
    //     ]);

    //     $post->update([
    //         'title' => $request->input('title'),
    //         'content' => $request->input('content'),
    //     ]);

    //     return redirect()->route('posts.show', $post->id)->with('status', '投稿を更新しました。');
    // }
