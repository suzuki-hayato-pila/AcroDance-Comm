<x-app-layout>
    <div class="max-w-7xl mx-auto p-6">
        <h2 class="text-2xl font-bold mb-4">活動場所の設定</h2>

        <!-- エラーメッセージの表示 -->
        @if($errors->any())
            <div class="text-red-500 mb-4">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- フォーム開始 -->
        <form method="POST" action="{{ route('posts.location.set') }}" id="locationForm">
            @csrf

            <!-- 住所検索フォーム -->
            <div class="mb-4">
                <label for="location-search" class="block text-sm font-medium text-gray-700">住所を入力</label>
                <input type="text" id="location-search" class="block w-full border-gray-300 rounded-md shadow-sm">
                <button id="search-location" type="button" class="mt-2 px-4 py-2 bg-blue-600 text-white rounded-md">検索</button>
            </div>

            <!-- 地図表示 -->
            <div id="map" class="w-full h-64 mb-4"></div>

            <!-- 緯度と経度 -->
            <input type="hidden" id="latitude" name="latitude">
            <input type="hidden" id="longitude" name="longitude">

            <!-- 選択した場所の名前 -->
            <div class="mb-4">
                <label for="location_name" class="block text-sm font-medium text-gray-700">活動場所の名前</label>
                <input type="text" id="location_name" name="location_name" class="block w-full border-gray-300 rounded-md shadow-sm" required>
            </div>

            <!-- 設定ボタン -->
            <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-md">活動場所を設定</button>
        </form>
        <!-- フォーム終了 -->
    </div>

    <!-- Google Maps のスクリプト -->
    <script>
        let map, marker;

        window.initMap = function initMap() {
            // 初期地図設定
            map = new google.maps.Map(document.getElementById("map"), {
                center: { lat: 35.6895, lng: 139.6917 }, // デフォルト位置（東京）
                zoom: 15,
            });

            // 地図クリック時の処理
            map.addListener("click", (event) => {
                const lat = event.latLng.lat(); // 緯度
                const lng = event.latLng.lng(); // 経度

                document.getElementById("latitude").value = lat;
                document.getElementById("longitude").value = lng;

                if (marker) marker.setMap(null); // 既存のマーカーを削除
                marker = new google.maps.Marker({
                    position: { lat, lng },
                    map: map,
                });
            });
        };

        // フォーム送信時の緯度・経度チェック
        document.addEventListener("DOMContentLoaded", () => {
            const locationForm = document.getElementById("locationForm");

            if (locationForm) {
                locationForm.addEventListener("submit", (e) => {
                    const lat = document.getElementById("latitude").value;
                    const lng = document.getElementById("longitude").value;

                    if (!lat || !lng) {
                        e.preventDefault();
                        alert("地図上で場所をクリックして、緯度と経度を指定してください。");
                    }
                });
            }
        });
    </script>
    <script
        src="https://maps.googleapis.com/maps/api/js?key={{ env('VITE_GOOGLE_MAPS_API_KEY') }}&callback=initMap&libraries=places"
        async
    ></script>
</x-app-layout>
