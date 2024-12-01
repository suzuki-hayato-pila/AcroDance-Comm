<x-app-layout>
    <div class="max-w-7xl mx-auto p-6">
        <!-- 上部タイトル部分 -->
        <div class="bg-gray-200 p-4 rounded-md">
            <h1 class="text-2xl font-bold">{{ $post->title }}</h1>
            <p class="text-gray-700">活動場所: {{ $post->location }}</p>
        </div>

        <!-- 地図表示部分 -->
        <div id="map" class="w-full h-64 my-6"></div>

        <!-- 活動場所の名前 -->
        <div class="bg-gray-100 p-4 rounded-md">
            <h3 class="text-lg font-bold">活動場所の名前</h3>
            <!-- 修正: $mapInfoが存在しない場合のエラーハンドリングを追加 -->
            <p class="text-gray-700">{{ $mapInfo->activity_location ?? 'データなし' }}</p>
        </div>

        <!-- 投稿の内容 -->
        <div class="bg-gray-100 p-4 mt-6 rounded-md">
            <h3 class="text-lg font-bold">内容</h3>
            <p class="text-gray-700">{{ $post->content }}</p>
        </div>
    </div>

    <!-- 地図表示用のJavaScript -->
    <script type="module">
        // 修正: Google Maps APIの読み込みを追加
        import { Loader } from "@googlemaps/js-api-loader";

        const loader = new Loader({
            apiKey: "{{ env('VITE_GOOGLE_MAPS_API_KEY') }}", // 修正: 環境変数の利用方法を修正
            libraries: ["places"],
        });

        loader.load().then(() => {
            // 修正: $mapInfoが存在しない場合のデフォルト値を設定
            const position = {
                lat: {{ $mapInfo->latitude ?? 0 }},
                lng: {{ $mapInfo->longitude ?? 0 }}
            };

            // 地図の初期化
            const map = new google.maps.Map(document.getElementById("map"), {
                center: position,
                zoom: 15,
            });

            // マーカーの追加
            new google.maps.Marker({
                position: position,
                map: map,
                title: "{{ $mapInfo->activity_location ?? '不明' }}", // 修正: エラーハンドリング
            });
        }).catch((error) => {
            console.error("Google Maps API の読み込みに失敗しました:", error);
        });
    </script>
</x-app-layout>
