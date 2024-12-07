{{-- <x-app-layout>
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
                <input type="text" id="location-search" class="block w-full border-gray-300 rounded-md shadow-sm" required>
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
    </div>

    <!-- Google Maps のスクリプト -->
    <script>
        let map, marker, geocoder;

        // 初期化
        function initMap() {
            // Geocoderのインスタンス作成
            geocoder = new google.maps.Geocoder();

            // 地図の初期設定
            map = new google.maps.Map(document.getElementById("map"), {
                center: { lat: 35.6895, lng: 139.6917 }, // デフォルト位置（東京）
                zoom: 15,
            });
        }

        // 住所検索ボタンのクリックイベント
        document.addEventListener("DOMContentLoaded", () => {
            const searchButton = document.getElementById("search-location");
            const locationForm = document.getElementById("locationForm");

            searchButton.addEventListener("click", () => {
                const address = document.getElementById("location-search").value;

                if (!address) {
                    alert("住所を入力してください。");
                    return;
                }

                // Geocoding APIで住所から緯度・経度を取得
                geocoder.geocode({ address: address }, (results, status) => {
                    if (status === "OK" && results.length > 0) {
                        const location = results[0].geometry.location;
                        const lat = location.lat();
                        const lng = location.lng();

                        // 地図のセンターを設定
                        map.setCenter(location);

                        // マーカーを設定
                        if (marker) marker.setMap(null); // 既存マーカーを削除
                        marker = new google.maps.Marker({
                            map: map,
                            position: location,
                        });

                        // 緯度・経度をフォームに設定
                        document.getElementById("latitude").value = lat;
                        document.getElementById("longitude").value = lng;
                    } else {
                        alert("住所の検索に失敗しました: " + status);
                    }
                });
            });

            // フォーム送信時のバリデーション
            locationForm.addEventListener("submit", (e) => {
                const lat = document.getElementById("latitude").value;
                const lng = document.getElementById("longitude").value;

                if (!lat || !lng) {
                    e.preventDefault();
                    alert("住所を検索して緯度と経度を取得してください。");
                }
            });
        });
    </script>
    <script
        src="https://maps.googleapis.com/maps/api/js?key={{ env('VITE_GOOGLE_MAPS_API_KEY') }}&callback=initMap&libraries=places"
        async
        defer
    ></script>
</x-app-layout> --}}
