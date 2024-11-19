<x-app-layout>
    <div class="max-w-7xl mx-auto p-6">
        <h2 class="text-2xl font-bold mb-4">投稿一覧</h2>

        @foreach ($posts as $post)
            <div class="border-b py-4">
                <h3 class="text-lg font-semibold">{{ $post->title }}</h3>
                <p class="text-gray-600">{{ $post->content }}</p>
                <p class="text-gray-500">活動場所: {{ $post->location }}</p>
            </div>
        @endforeach
    </div>
</x-app-layout>
