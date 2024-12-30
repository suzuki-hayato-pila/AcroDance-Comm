import { defineConfig } from "vite";
import laravel from "laravel-vite-plugin";
import dotenv from "dotenv"; // dotenvをインポート

// dotenvの設定を初期化
dotenv.config();

// ビルド時の環境変数をデバッグ出力
console.log(
    "ビルド時の VITE_GOOGLE_MAPS_API_KEY:",
    process.env.VITE_GOOGLE_MAPS_API_KEY
);

export default defineConfig({
    plugins: [
        laravel({
            input: [
                "resources/css/app.css",
                "resources/js/app.js",
                "resources/js/create.js",
                "resources/js/show.js",
                "resources/js/search.js", // これを追加
            ], // 新しいエントリーポイント],
            refresh: true,
        }),
    ],
    // resolve: {
    //     alias: {
    //         "@googlemaps/marker-advanced":
    //             "/node_modules/@googlemaps/marker-advanced/dist/index.umd.js",
    //     },
    // },
    define: {
        // 環境変数をJavaScriptで利用できるように渡す
        "import.meta.env.VITE_GOOGLE_MAPS_API_KEY": JSON.stringify(
            process.env.VITE_GOOGLE_MAPS_API_KEY
        ),
    },
});
