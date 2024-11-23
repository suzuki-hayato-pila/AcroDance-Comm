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

    {{-- <!-- Google Maps API のスクリプト -->
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAWuoxBCl5BZTHV7d5i4eAF3YR2l8daxKg&libraries=places&callback=initMap" async defer></script>
    <script>
        let map, marker;

        // 初期化
        function initMap() {
            const initialPosition = { lat: 35.6895, lng: 139.6917 }; // 東京の初期位置
            map = new google.maps.Map(document.getElementById("map"), {
                center: initialPosition,
                zoom: 15,
                mapId: "45ae2f4f306b728c", // マップ ID を設定
            });

            // Marker を利用
            marker = new google.maps.Marker({
                position: initialPosition,
                map: map,
                title: "選択した場所",
            });
        }

        // 住所検索機能
        document.getElementById("search-location").addEventListener("click", () => {
            const address = document.getElementById("location-search").value;
            const geocoder = new google.maps.Geocoder();

            geocoder.geocode({ address }, (results, status) => {
                if (status === "OK") {
                    const position = results[0].geometry.location;
                    map.setCenter(position);

                    // Marker を更新
                    marker.setMap(null); // 既存のマーカーを削除
                    marker = new google.maps.Marker({
                        position: position,
                        map: map,
                        title: address,
                    });
                } else {
                    alert("場所を特定できませんでした: " + status);
                }
            });
        });

        // 活動場所の設定
        document.getElementById("set-location").addEventListener("click", () => {
            const locationName = document.getElementById("location-name").value;
            if (locationName) {
                sessionStorage.setItem("selectedLocation", locationName);
                window.location.href = "{{ route('posts.create') }}";
            } else {
                alert("活動場所の名前を入力してください");
            }
        });
    </script> --}}
</x-app-layout>
