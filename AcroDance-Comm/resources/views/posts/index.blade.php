<x-app-layout>
    {{-- @if (session('success'))
    <div class="bg-green-200 text-green-700 p-4 rounded-md">
        {{ session('success') }}
    </div>
    @endif

    <div class="max-w-7xl mx-auto p-6 pb-20">
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

    </div> --}}
    {{-- 簡素化してトライした分 --}}
    <h1>投稿一覧</h1>
    {{-- @foreach ($posts as $post)
        <p>{{ $post->title }}</p>
    @endforeach --}}


</x-app-layout>
