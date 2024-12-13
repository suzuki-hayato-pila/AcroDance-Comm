{{-- <x-app-layout>
    <div class="max-w-7xl mx-auto p-6">
        <h1 class="text-xl font-bold">検索ページ</h1>
        <p>このページは検索機能を実装する予定です。</p>
    </div>
</x-app-layout> --}}

{{-- <x-app-layout>
    <div class="max-w-7xl mx-auto p-6 pb-20">
        <!-- 検索ページタイトル -->
        <h1 class="text-xl font-bold mb-4">検索ページ</h1>
        <p class="mb-6">このページは投稿を検索できます！</p>

        <!-- 投稿一覧 -->
        <h2 class="text-2xl font-bold mb-4">投稿一覧</h2>
        @foreach ($posts as $post)
            <div class="border-b py-4">
                <a href="{{ route('posts.show', $post->id) }}" class="text-lg font-semibold text-blue-500 hover:underline">
                    {{ $post->title }}
                </a>
                <p class="text-gray-600">{{ $post->content }}</p>
                <p class="text-gray-500">活動場所: {{ $post->location_name }}</p>
            </div>
        @endforeach

        <!-- ページネーション -->
        <div class="mt-4">
            {{ $posts->links() }}
        </div>
    </div>
</x-app-layout> --}}

<<x-app-layout>
    <div class="max-w-7xl mx-auto p-6 pb-20">
        <!-- 検索フォーム -->
        <h1 class="text-xl font-bold mb-4">検索ページ</h1>
        <form method="GET" action="{{ route('search') }}" class="mb-6 flex space-x-4">
            <div class="flex-grow">
                <!-- キーワード入力 -->
                <input
                    type="text"
                    name="keyword"
                    value="{{ request('keyword') }}"
                    placeholder="検索キーワードを入力"
                    class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                />
            </div>

            <!-- 検索ボタン -->
            <button
                type="submit"
                class="px-4 py-2 bg-blue-600 text-white rounded-md shadow hover:bg-blue-700"
            >
                検索
            </button>

            <!-- リセットボタン -->
            <a
                href="{{ route('search.reset') }}"
                class="px-4 py-2 bg-gray-300 text-black rounded-md shadow hover:bg-gray-400"
            >
                リセット
            </a>
        </form>

        <!-- 検索結果または投稿一覧 -->
        <h2 class="text-2xl font-bold mb-4">検索結果</h2>
        @if ($posts->isNotEmpty())
            @foreach ($posts as $post)
                <div class="border-b py-4">
                    <a href="{{ route('posts.show', $post->id) }}" class="text-lg font-semibold text-blue-500 hover:underline">
                        {{ $post->title }}
                    </a>
                    <p class="text-gray-600">{{ $post->content }}</p>
                    <p class="text-gray-500">活動場所: {{ $post->location_name }}</p>
                </div>
            @endforeach

            <!-- ページネーション -->
            <div class="mt-4">
                {{ $posts->links() }}
            </div>
        @else
            <p class="text-gray-500">該当する投稿が見つかりませんでした。</p>
        @endif
    </div>
</x-app-layout>


