import "./bootstrap";
import Alpine from "alpinejs";
import { Loader } from "@googlemaps/js-api-loader";

window.Alpine = Alpine;
Alpine.start();

const loader = new Loader({
    apiKey: import.meta.env.VITE_GOOGLE_MAPS_API_KEY, // APIキーを.envから読み込み
    libraries: ["places"], // 必要なライブラリ
});

loader.load().then(() => {
    const currentUrl = window.location.pathname; // 現在のURLを取得

    if (currentUrl.includes("/posts/create")) {
        initCreateMap(); // create.blade.php用の地図初期化関数
    } else if (currentUrl.includes("/posts/")) {
        initShowMap(); // show.blade.php用の地図初期化関数
    }
});

// create.blade.php用の地図初期化
function initCreateMap() {
    const mapElement = document.getElementById("map");
    if (!mapElement) return; // 地図要素がなければ処理を終了

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
}

// show.blade.php用の地図初期化
function initShowMap() {
    const mapElement = document.getElementById("map");
    if (!mapElement) return; // 地図要素がなければ処理を終了

    const latitude = parseFloat(mapElement.dataset.latitude);
    const longitude = parseFloat(mapElement.dataset.longitude);
    const locationName = mapElement.dataset.locationName;

    const map = new google.maps.Map(mapElement, {
        center: { lat: latitude, lng: longitude },
        zoom: 15,
    });

    new google.maps.Marker({
        position: { lat: latitude, lng: longitude },
        map,
        title: locationName,
    });
}
