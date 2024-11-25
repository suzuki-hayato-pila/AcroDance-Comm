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
            <p class="text-gray-700">{{ $post->location_name }}</p>
        </div>

        <!-- 投稿の内容 -->
        <div class="bg-gray-100 p-4 mt-6 rounded-md">
            <h3 class="text-lg font-bold">内容</h3>
            <p class="text-gray-700">{{ $post->content }}</p>
        </div>
    </div>

    <!-- 地図表示用のJavaScript -->
    <script type="module">
        import { Loader } from "@googlemaps/js-api-loader";

        const loader = new Loader({
            apiKey: import.meta.env.VITE_GOOGLE_MAPS_API_KEY, // Vite環境変数からAPIキーを取得
            libraries: ["places"],
        });

        let map, marker;

        loader.load().then(() => {
            // 投稿から取得した緯度経度を利用
            const position = { lat: {{ $post->latitude }}, lng: {{ $post->longitude }} };

            // 地図の初期化
            map = new google.maps.Map(document.getElementById("map"), {
                center: position,
                zoom: 15,
            });

            // マーカーを表示
            marker = new google.maps.Marker({
                position: position,
                map: map,
                title: "{{ $post->location_name }}",
            });
        }).catch((error) => {
            console.error("Google Maps API の読み込みに失敗しました:", error);
        });
    </script>
</x-app-layout>
