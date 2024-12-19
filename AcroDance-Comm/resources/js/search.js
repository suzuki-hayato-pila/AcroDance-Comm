import { Loader } from "@googlemaps/js-api-loader";

const loader = new Loader({
    apiKey: import.meta.env.VITE_GOOGLE_MAPS_API_KEY, // Google Maps APIキー
    libraries: ["places"], // 必要なライブラリ
});

loader.load().then(() => {
    // サムネイル用のすべての地図要素を取得
    const mapElements = document.querySelectorAll("[id^=map-thumbnail-]");
    if (mapElements.length === 0) {
        console.error("No map elements found.");
        return;
    }

    mapElements.forEach((mapElement) => {
        // データ属性から値を取得
        const latitude = parseFloat(mapElement.dataset.latitude);
        const longitude = parseFloat(mapElement.dataset.longitude);
        const locationName = mapElement.dataset.locationName;

        // データの検証
        if (isNaN(latitude) || isNaN(longitude)) {
            console.error("Invalid latitude or longitude:", {
                latitude,
                longitude,
            });
            mapElement.innerHTML = "<p>地図データが不正です。</p>";
            return;
        }

        // Google Mapsを初期化
        const map = new google.maps.Map(mapElement, {
            center: { lat: latitude, lng: longitude },
            zoom: 13,
            disableDefaultUI: true, // デフォルトUIを無効化
            gestureHandling: "none", // ユーザーの操作を無効化
            zoomControl: false, // ズームボタンを非表示
        });

        // マーカーを設定
        new google.maps.Marker({
            position: { lat: latitude, lng: longitude },
            map,
            title: locationName,
        });
    });
});
