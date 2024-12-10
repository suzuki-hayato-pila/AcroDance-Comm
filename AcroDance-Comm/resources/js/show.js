import { Loader } from "@googlemaps/js-api-loader";

const loader = new Loader({
    apiKey: import.meta.env.VITE_GOOGLE_MAPS_API_KEY, // Google Maps APIキー
    libraries: ["places"], // 必要なライブラリ
});

loader.load().then(() => {
    const mapElement = document.getElementById("map");
    if (!mapElement) return; // 地図要素がない場合は終了

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
});
