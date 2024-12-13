<x-app-layout>
    <div class="max-w-3xl mx-auto p-6 bg-blue-100 shadow-md rounded-lg">
        <h2 class="text-3xl font-bold mb-6 text-center">新規投稿</h2>
        <form method="POST" action="{{ route('posts.store') }}" id="postForm" class="pb-20">
            @csrf
            <!-- タイトル -->
            <div class="mb-6">
                <label for="title" class="block text-lg font-medium text-gray-700">タイトル</label>
                <input type="text" id="title" name="title" required
                    class="w-full border-gray-300 rounded-lg shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200">
            </div>

            <!-- 内容 -->
            <div class="mb-6">
                <label for="content" class="block text-lg font-medium text-gray-700">内容</label>
                <textarea id="content" name="content" rows="4" required
                    class="w-full border-gray-300 rounded-lg shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200"></textarea>
            </div>

            <!-- 活動場所 -->
            <div class="mb-6">
                <label for="location_name" class="block text-lg font-medium text-gray-700">活動場所</label>
                <input type="text" id="location_name" name="location_name" required
                    class="w-full border-gray-300 rounded-lg shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200">
                <button type="button" id="search-location" class="mt-2 px-4 py-2 bg-blue-600 text-white rounded-md">住所を検索</button>
            </div>

            <!-- 地図表示 -->
            <div id="map" class="w-full h-64 mb-4"></div>

            <!-- 緯度と経度 (hidden) -->
            <input type="hidden" id="latitude" name="latitude">
            <input type="hidden" id="longitude" name="longitude">

            <!-- 希望性別 -->
            <div class="mb-6">
                <label for="preferred_gender" class="block text-lg font-medium text-gray-700">希望性別</label>
                <select id="preferred_gender" name="preferred_gender"
                    class="w-full border-gray-300 rounded-lg shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200">
                    <option value="">指定なし</option>
                    <option value="male">男</option>
                    <option value="female">女</option>
                </select>
            </div>

            <!-- 希望人数 -->
            <div class="mb-6">
                <label for="preferred_group_size" class="block text-lg font-medium text-gray-700">希望人数</label>
                <select id="preferred_group_size" name="preferred_group_size"
                    class="w-full border-gray-300 rounded-lg shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200">
                    <option value="">指定なし</option>
                    <option value="one">一人</option>
                    <option value="two">二人</option>
                    <option value="three">三人</option>
                </select>
            </div>

            <!-- 投稿ボタン -->
            <div class="text-center">
                <button type="submit"
                    class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white font-semibold rounded-md">
                    投稿する
                </button>
            </div>
        </form>
    </div>

    <!-- create.js を読み込む -->
    <script type="module" src="{{ mix('resources/js/create.js') }}"></script>


</x-app-layout>
