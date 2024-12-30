{{-- <x-app-layout>
    @if (session('success'))
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
    {{-- <h1>投稿一覧</h1> --}}
    {{-- @foreach ($posts as $post)
        <p>{{ $post->title }}</p>
    @endforeach --}}


{{-- </x-app-layout> --}}


{{-- <x-app-layout>
    @if (session('success'))
    <div class="bg-green-200 text-green-700 p-4 rounded-md">
        {{ session('success') }}
    </div>
    @endif

    <div class="max-w-7xl mx-auto p-6 pb-20">
        <h2 class="text-2xl font-bold mb-4">投稿一覧</h2>

        @foreach ($posts as $post)
            <div class="flex items-start border-b py-4">
                <!-- 地図サムネイル -->
                @if ($post->mapInfo)
                <div class="w-24 h-24 mr-4">
                    <div id="map-thumbnail-{{ $post->id }}" class="w-full h-full rounded-md"></div>
                </div>
                @endif

                <div>
                    <a href="{{ route('posts.show', $post->id) }}" class="text-lg font-semibold text-blue-500 hover:underline">
                        {{ $post->title }}
                    </a>
                    <p class="text-gray-600">{{ $post->content }}</p>
                    <p class="text-gray-500">活動場所: {{ $post->location_name }}</p>
                </div>
            </div>
        @endforeach

        <!-- ページネーション -->
        <div class="mt-4">
            {{ $posts->links() }}
        </div>
    </div>

    <!-- 地図サムネイル用JavaScript -->
    <script type="module" src="{{ mix('resources/js/index.js') }}"></script>
        <!-- create.js を Vite で読み込む -->
    @vite('resources/js/index.js')

</x-app-layout> --}}
