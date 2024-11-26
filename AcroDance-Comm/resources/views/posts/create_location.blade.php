<x-app-layout>
    <div class="max-w-7xl mx-auto p-6">
        <h2 class="text-2xl font-bold mb-4">活動場所の設定</h2>
        <!-- 住所検索フォーム -->
        <div class="mb-4">
            <label for="location-search" class="block text-sm font-medium text-gray-700">住所を入力</label>
            <input type="text" id="location-search" class="block w-full border-gray-300 rounded-md shadow-sm">
            <button id="search-location" class="mt-2 px-4 py-2 bg-blue-600 text-white rounded-md">検索</button>
        </div>

        <!-- 地図表示 -->
        <div id="map" class="w-full h-64 mb-4"></div>

        <!-- 選択した場所の名前 -->
        <div class="mb-4">
            <label for="location-name" class="block text-sm font-medium text-gray-700">活動場所の名前</label>
            <input type="text" id="location-name" class="block w-full border-gray-300 rounded-md shadow-sm">
        </div>

        <!-- 設定ボタン -->
        <button id="set-location" class="px-4 py-2 bg-blue-600 text-white rounded-md">活動場所を設定</button>
    </div>

</x-app-layout>
