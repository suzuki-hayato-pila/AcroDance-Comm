import { Loader } from "@googlemaps/js-api-loader";

const loader = new Loader({
    apiKey: import.meta.env.VITE_GOOGLE_MAPS_API_KEY, // Google Maps APIキー
    libraries: ["places"], // 必要なライブラリ
});

loader.load().then(() => {
    const mapElement = document.getElementById("map");
    if (!mapElement) return; // 地図要素がない場合は終了

    const geocoder = new google.maps.Geocoder();
    const map = new google.maps.Map(mapElement, {
        center: {
            lat: parseFloat(mapElement.dataset.latitude) || 35.6895, // 初期値: 東京
            lng: parseFloat(mapElement.dataset.longitude) || 139.6917,
        },
        zoom: 15,
    });

    let marker = new google.maps.Marker({
        map,
        position: {
            lat: parseFloat(mapElement.dataset.latitude) || 35.6895,
            lng: parseFloat(mapElement.dataset.longitude) || 139.6917,
        },
    });

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
