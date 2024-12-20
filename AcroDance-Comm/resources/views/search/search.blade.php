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

{{-- <<x-app-layout>
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
</x-app-layout> --}}


<x-app-layout>
    <div class="max-w-7xl mx-auto p-6 pb-20 bg-blue-100">
        <!-- 検索フォーム -->
        <div class="bg-gray-200 p-4 rounded-md shadow-md">
            <h1 class="text-3xl font-bold text-center">投稿一覧</h1>
        </div>

        <form method="GET" action="{{ route('search') }}" class="mt-6 mb-6 flex space-x-4">
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
                <div class="flex items-start border-b border-gray-900 py-4 bg-gray-100">
                    <!-- 地図サムネイル -->
                    @if ($post->mapInfo)
                    <div class="flex-shrink-0 w-24 h-24 mr-4">
                        <div
                            id="map-thumbnail-{{ $post->id }}"
                            class="w-full h-full rounded-md"
                            data-latitude="{{ $post->mapInfo->latitude }}"
                            data-longitude="{{ $post->mapInfo->longitude }}"
                        ></div>
                    </div>
                    @endif

                    <div>
                        <a href="{{ route('posts.show', $post->id) }}" class="text-lg font-semibold text-blue-900 hover:underline">
                            {{ $post->title }}
                        </a>
                        <p class="text-gray-900">{{ $post->content }}</p>
                        <p class="text-gray-500">活動場所: {{ $post->location_name }}</p>
                    </div>
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

    <!-- 地図サムネイル用JavaScript -->
    <script type="module" src="{{ mix('resources/js/search.js') }}"></script>
</x-app-layout>

