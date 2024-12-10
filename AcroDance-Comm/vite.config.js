import { defineConfig } from "vite";
import laravel from "laravel-vite-plugin";
import dotenv from "dotenv"; // dotenvをインポート

// dotenvの設定を初期化
dotenv.config();

export default defineConfig({
    plugins: [
        laravel({
            input: [
                "resources/css/app.css",
                "resources/js/app.js",
                "resources/js/create.js",
                "resources/js/show.js",
            ], // 新しいエントリーポイント],
            refresh: true,
        }),
    ],
    resolve: {
        alias: {
            "@googlemaps/marker-advanced":
                "/node_modules/@googlemaps/marker-advanced/dist/index.umd.js",
        },
    },
});
