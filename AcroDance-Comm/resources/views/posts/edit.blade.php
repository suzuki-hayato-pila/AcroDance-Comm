<x-app-layout>
    <div class="max-w-7xl mx-auto p-6 space-y-6 pb-24 bg-blue-100" >
        <!-- タイトル -->
        {{-- <div class="bg-gray-200 p-4 rounded-md shadow-md"> --}}
            <h1 class="text-3xl font-bold text-blue-900">編集画面</h1>
        {{-- </div> --}}

        <!-- 編集フォーム -->
        <form method="POST" action="{{ route('posts.update', $post->id) }}" class="space-y-4">
            @csrf
            @method('PATCH')

            <!-- タイトル -->
            <div>
                <label for="title" class="block text-sm font-medium text-gray-700">タイトル</label>
                <input type="text" name="title" id="title" value="{{ $post->title }}"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
            </div>

            <!-- 内容 -->
            <div>
                <label for="content" class="block text-sm font-medium text-gray-700">内容</label>
                <textarea name="content" id="content" rows="4"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">{{ $post->content }}</textarea>
            </div>

            <!-- 活動場所 -->
            <div>
                <label for="location_name" class="block text-sm font-medium text-gray-700">活動場所</label>
                <input type="text" name="location_name" id="location_name" value="{{ $post->location_name }}"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                <button type="button" id="search-location"
                    class="mt-2 px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">
                    住所を検索
                </button>
            </div>

            <!-- 地図 -->
            <div id="map" class="w-full h-64 rounded-md shadow-md"
                data-latitude="{{ $post->mapInfo->latitude ?? '35.6895' }}"
                data-longitude="{{ $post->mapInfo->longitude ?? '139.6917' }}"
                data-location-name="{{ $post->mapInfo->activity_location ?? '不明な場所' }}">
            </div>

            <input type="hidden" id="latitude" name="latitude" value="{{ $post->mapInfo->latitude ?? '' }}">
            <input type="hidden" id="longitude" name="longitude" value="{{ $post->mapInfo->longitude ?? '' }}">


            {{-- <!-- 希望性別 -->
            <div>
                <label for="preferred_gender" class="block text-sm font-medium text-gray-700">希望性別</label>
                <select name="preferred_gender" id="preferred_gender"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                    <option value="指定なし" {{ $post->preferred_gender === '指定なし' ? 'selected' : '' }}>指定なし</option>
                    <option value="男性" {{ $post->preferred_gender === '男性' ? 'selected' : '' }}>男性</option>
                    <option value="女性" {{ $post->preferred_gender === '女性' ? 'selected' : '' }}>女性</option>
                </select>
            </div> --}}

            <!-- 希望性別 -->
            <div>
                <label for="preferred_gender" class="block text-sm font-medium text-gray-700">希望性別</label>
                <select name="preferred_gender" id="preferred_gender"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                    <option value="指定なし" {{ $post->preferred_gender === '指定なし' ? 'selected' : '' }}>指定なし</option>
                    <option value="male" {{ $post->preferred_gender === 'male' ? 'selected' : '' }}>男性</option>
                    <option value="female" {{ $post->preferred_gender === 'female' ? 'selected' : '' }}>女性</option>
                </select>
            </div>


            {{-- <!-- 希望人数 -->
            <div>
                <label for="preferred_group_size" class="block text-sm font-medium text-gray-700">希望人数</label>
                <select name="preferred_group_size" id="preferred_group_size"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                    <option value="指定なし" {{ $post->preferred_group_size === '指定なし' ? 'selected' : '' }}>指定なし</option>
                    <option value="1人" {{ $post->preferred_group_size === '1人' ? 'selected' : '' }}>1人</option>
                    <option value="2人" {{ $post->preferred_group_size === '2人' ? 'selected' : '' }}>2人</option>
                    <option value="3人" {{ $post->preferred_group_size === '3人' ? 'selected' : '' }}>3人</option>
                </select>
            </div> --}}

            <!-- 希望人数 -->
            <div>
                <label for="preferred_group_size" class="block text-sm font-medium text-gray-700">希望人数</label>
                <select name="preferred_group_size" id="preferred_group_size"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                    <option value="指定なし" {{ $post->preferred_group_size === '指定なし' ? 'selected' : '' }}>指定なし</option>
                    <option value="one" {{ $post->preferred_group_size === 'one' ? 'selected' : '' }}>1人</option>
                    <option value="two" {{ $post->preferred_group_size === 'two' ? 'selected' : '' }}>2人</option>
                    <option value="three" {{ $post->preferred_group_size === 'three' ? 'selected' : '' }}>3人</option>
                </select>
            </div>

            <!-- 保存ボタン -->
            <div class="text-center">
                <button type="submit"
                    class="px-4 py-2 font-bold bg-blue-600 text-white rounded-md shadow hover:bg-blue-700">
                    保存する
                </button>
            </div>
        </form>
    </div>

    {{-- <!-- Google Maps JavaScript -->
    <script type="module" src="{{ mix('resources/js/edit.js') }}"></script> --}}
        <!-- create.js を Vite で読み込む -->
        @vite('resources/js/edit.js')
</x-app-layout>
