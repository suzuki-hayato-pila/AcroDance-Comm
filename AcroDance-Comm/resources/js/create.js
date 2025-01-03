import { Loader } from "@googlemaps/js-api-loader";

const loader = new Loader({
    apiKey: import.meta.env.VITE_GOOGLE_MAPS_API_KEY, // Google Maps APIキー
    libraries: ["places"], // 必要なライブラリ
});

// // Vite の環境変数を取得
// const apiKey = import.meta.env.VITE_GOOGLE_MAPS_API_KEY;

// // 環境変数のデバッグ用ログ
// console.log("Google Maps API Key from Vite:", apiKey);

// if (!apiKey) {
//     console.error("Google Maps API Key is missing or undefined.");
// }

// const loader = new Loader({
//     apiKey: apiKey, // 正しい API キーを設定
//     libraries: ["places"], // 必要なライブラリ
// });

// 環境変数の確認用ログ（デバッグ用）
// console.log("Google Maps API Key:", import.meta.env.VITE_GOOGLE_MAPS_API_KEY);

// // Google Maps APIキーを読み込む（undefined の場合はエラー表示）
// const apiKey =
//     import.meta.env.VITE_GOOGLE_MAPS_API_KEY ||
//     "自分のAPI KEY"; // 必要に応じてデフォルト値を設定
// if (!apiKey || apiKey === "自分のAPI Key") {
//     console.error("Google Maps API Key is missing or undefined.");
// }

// const loader = new Loader({
//     apiKey: apiKey, // 修正済み: 必ず有効なAPIキーを渡す
//     libraries: ["places"], // 必要なライブラリ
// });

// const loader = new Loader({
//     apiKey: import.meta.env.VITE_GOOGLE_MAPS_API_KEY, // Google Maps APIキー
//     libraries: ["places"], // 必要なライブラリ
// });

loader.load().then(() => {
    const mapElement = document.getElementById("map");
    if (!mapElement) return; // 地図要素がない場合は終了

    const geocoder = new google.maps.Geocoder();
    const map = new google.maps.Map(mapElement, {
        center: { lat: 35.6895, lng: 139.6917 }, // 東京の初期位置
        zoom: 15,
    });

    let marker = null;

    document.getElementById("search-location").addEventListener("click", () => {
        const address = document.getElementById("location_name").value;
        if (!address) {
            alert("住所を入力してください。");
            return;
        }

        geocoder.geocode({ address: address }, (results, status) => {
            if (status === "OK" && results.length > 0) {
                const location = results[0].geometry.location;

                map.setCenter(location);

                if (marker) marker.setMap(null);
                marker = new google.maps.Marker({
                    map,
                    position: location,
                });

                document.getElementById("latitude").value = location.lat();
                document.getElementById("longitude").value = location.lng();
            } else {
                alert("住所の検索に失敗しました: " + status);
            }
        });
    });
});
