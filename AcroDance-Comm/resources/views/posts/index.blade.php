<x-app-layout>
    <div class="max-w-7xl mx-auto p-6 pb-20">
        <h2 class="text-2xl font-bold mb-4">投稿一覧</h2>

        @foreach ($posts as $post)
            <div class="border-b py-4">
                <!-- 投稿タイトルに詳細ページへのリンクを追加 -->
                <a href="{{ route('posts.show', $post->id) }}" class="text-lg font-semibold text-blue-500">
                    {{ $post->title }}
                </a>
                <p class="text-gray-600">{{ $post->content }}</p>
                <p class="text-gray-500">活動場所: {{ $post->location_name }}</p>
            </div>
        @endforeach
    </div>
</x-app-layout>
