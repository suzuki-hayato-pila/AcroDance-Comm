// import './bootstrap';

// import Alpine from 'alpinejs';

// window.Alpine = Alpine;

// Alpine.start();

import "./bootstrap";
import Alpine from "alpinejs";
window.Alpine = Alpine;
Alpine.start();

// Google Maps API Loader のコードを追加
import { Loader } from "@googlemaps/js-api-loader";

const loader = new Loader({
    apiKey: import.meta.env.VITE_GOOGLE_MAPS_API_KEY, // Google Maps APIキーを.envから読み込む場合も可能
    libraries: ["places"], // 必要なライブラリ
});

let map, marker;

loader.load().then(() => {
    const initialPosition = { lat: 35.6895, lng: 139.6917 }; // 東京の初期位置

    map = new google.maps.Map(document.getElementById("map"), {
        center: initialPosition,
        zoom: 15,
    });

    marker = new google.maps.Marker({
        position: initialPosition,
        map: map,
        title: "選択した場所",
    });

    // イベントリスナーの設定
    document.getElementById("search-location").addEventListener("click", () => {
        const address = document.getElementById("location-search").value;
        const geocoder = new google.maps.Geocoder();

        geocoder.geocode({ address }, (results, status) => {
            if (status === "OK") {
                const position = results[0].geometry.location;
                map.setCenter(position);

                marker.setMap(null); // 古いマーカーを削除
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

    document.getElementById("set-location").addEventListener("click", () => {
        const locationName = document.getElementById("location-name").value;
        if (locationName) {
            sessionStorage.setItem("selectedLocation", locationName);
            window.location.href = "/posts/create";
        } else {
            alert("活動場所の名前を入力してください");
        }
    });
});
