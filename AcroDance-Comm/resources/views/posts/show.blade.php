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
    <div class="max-w-7xl mx-auto p-6 pb-20 bg-blue-100">
        <!-- 上部タイトル部分 -->
        <div class="bg-gray-100 p-4 rounded-md text-center">
            <h1 class="text-2xl font-bold text-blue-900">{{ $post->title }}</h1>
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

        {{-- <!-- 希望情報 -->
        <div class="bg-gray-100 p-4 mt-6 rounded-md">
            <p class="text-gray-700"><strong>希望性別:</strong> {{ $post->preferred_gender ?? '指定なし' }}</p>
            <p class="text-gray-700"><strong>希望人数:</strong> {{ $post->preferred_group_size ?? '指定なし' }}</p>
        </div> --}}

                <!-- 希望情報 -->
        <div class="bg-gray-100 p-4 mt-6 rounded-md">
            <p class="text-gray-700">
                <strong>希望性別:</strong>
                @if ($post->preferred_gender === 'male')
                    男性
                @elseif ($post->preferred_gender === 'female')
                    女性
                @else
                    指定なし
                @endif
            </p>
            <p class="text-gray-700">
                <strong>希望人数:</strong>
                @if ($post->preferred_group_size === 'one')
                    1人
                @elseif ($post->preferred_group_size === 'two')
                    2人
                @elseif ($post->preferred_group_size === 'three')
                    3人
                @else
                    指定なし
                @endif
            </p>
        </div>

        <!-- 投稿者情報 -->
        <div class="bg-gray-100 p-4 mt-6 rounded-md">
            <div class="flex items-center space-x-4">
                <!-- プロフィール画像 -->
                <div class="relative w-16 h-16 rounded-full bg-gray-200 flex-shrink-0">
                    @if ($post->user->profile_photo)
                        <img src="{{ asset('storage/' . $post->user->profile_photo) }}" alt="プロフィール画像" class="w-full h-full object-cover rounded-full">
                         {{-- <img src="{{ asset('path-to-avatar.png') }}" alt="プロフィール画像" class="w-16 h-16 rounded-full"> --}}
                    @else
                        <span class="text-center text-gray-500 text-sm font-semibold flex items-center justify-center h-full">プロフィール画像</span>
                    @endif
                </div>
                <!-- 投稿者情報ラベルとテキスト -->
                <div class="flex-grow overflow-hidden">
                    <h3 class="text-lg font-bold truncate">投稿者情報</h3>
                    <p class="text-lg font-semibold truncate">{{ $post->user->name }}</p>
                    <a href="{{ $post->user->instagram }}" target="_blank" class="text-blue-500 hover:underline block truncate">
                        {{ $post->user->instagram }}
                    </a>
                    <p class="mt-2 text-gray-700 break-words">
                        <strong>自己紹介:</strong>
                        {{ $post->user->bio ?? '自己紹介がまだありません。' }}
                    </p>
                </div>
            </div>
        </div>



        <!-- 編集・削除ボタン（ログインユーザーの投稿のみ表示） -->
        @if (auth()->check() && auth()->id() === $post->user_id)
        {{-- <div class="flex justify-end mt-4 space-x-2"> --}}
        <div class="bg-gray-100 p-4 rounded-md mt-6 flex items-center space-x-4 mb-20">
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

    </div>


    {{-- <!-- show.js を読み込む -->
    <script type="module" src="{{ mix('resources/js/show.js') }}"></script> --}}
        <!-- create.js を Vite で読み込む -->
        @vite('resources/js/show.js')

</x-app-layout>