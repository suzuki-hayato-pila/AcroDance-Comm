{{-- <x-app-layout>
    <div class="max-w-7xl mx-auto p-6">
        <h1 class="text-xl font-bold">検索ページ</h1>
        <p>このページは検索機能を実装する予定です。</p>
    </div>
</x-app-layout> --}}

<x-app-layout>
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
</x-app-layout>
