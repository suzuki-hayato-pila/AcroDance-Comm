{{-- <x-app-layout>
    <div class="max-w-7xl mx-auto p-6 space-y-6">
        <!-- 投稿タイトル -->
        <div class="bg-gray-200 p-4 rounded-md shadow-md">
            <h1 class="text-2xl font-bold">{{ $post->title }}</h1>
        </div>

        <!-- 活動場所情報 -->
        <div class="bg-gray-100 p-4 rounded-md shadow-md">
            <h3 class="text-lg font-bold mb-2">活動場所の名前</h3>
            <p class="text-gray-700">
                {{ $post->mapInfo->activity_location ?? 'データなし' }}
            </p>
        </div>

        <!-- 地図表示 -->
        <div id="map" class="w-full h-64 rounded-md shadow-md"></div>

    </div>
</x-app-layout> --}}


<x-app-layout>
    <div class="max-w-7xl mx-auto p-6">
        <!-- 上部タイトル部分 -->
        <div class="bg-gray-200 p-4 rounded-md">
            <h1 class="text-2xl font-bold">{{ $post->title }}</h1>
            <p class="text-gray-700">活動場所: {{ $post->location_name }}</p>
        </div>

        {{-- <!-- デバッグ情報 -->
        <pre>
            {{ print_r($post->mapInfo) }}
        </pre> --}}

        <!-- 地図表示部分 -->
        <div id="map" class="w-full h-64 my-6"
            class="w-full h-64 my-6"
            data-latitude="{{ $post->mapInfo->latitude ?? '0' }}"
            data-longitude="{{ $post->mapInfo->longitude ?? '0' }}"
            data-location-name="{{ $post->mapInfo->activity_location ?? '不明な場所' }}"
        ></div>
        {{-- <pre>{{ print_r($post->mapInfo) }}</pre> --}}

        <!-- 活動場所の名前 -->
        <div class="bg-gray-100 p-4 rounded-md">
            <h3 class="text-lg font-bold">活動場所の名前</h3>
            {{-- <p class="text-gray-700">{{ $mapInfo->activity_location ?? 'データなし' }}</p> --}}
            <p class="text-gray-700">
                {{ $post->mapInfo->activity_location ?? 'データなし' }}
            </p>
        </div>

        <!-- 投稿の内容 -->
        <div class="bg-gray-100 p-4 mt-6 rounded-md">
            <h3 class="text-lg font-bold">内容</h3>
            <p class="text-gray-700">{{ $post->content }}</p>
        </div>
    </div>

        <!-- 編集・削除ボタン（ログインユーザーの投稿のみ表示） -->
        @if (auth()->check() && auth()->id() === $post->user_id)
        <div class="flex justify-end mt-4 space-x-2">
            <!-- 編集ボタン -->
            <a href="{{ route('posts.edit', $post->id) }}"
                class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">
                編集
            </a>

            <!-- 削除ボタン -->
            <form method="POST" action="{{ route('posts.destroy', $post->id) }}"
                    onsubmit="return confirm('本当に削除しても大丈夫ですか？');">
                @csrf
                @method('DELETE')
                <button type="submit"
                        class="px-4 py-2 bg-red-600 text-white rounded-md hover:bg-red-700">
                    削除
                </button>
            </form>
        </div>
    @endif

    <!-- show.js を読み込む -->
    <script type="module" src="{{ mix('resources/js/show.js') }}"></script>

</x-app-layout>