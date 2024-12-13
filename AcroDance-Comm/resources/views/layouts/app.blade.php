<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>{{ config('app.name', 'Laravel') }}</title>
        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased bg-blue-100">
        <!-- 上部ナビゲーション -->
        <x-header />
        <!-- 全体のコンテナ -->
        <div class="flex flex-col min-h-screen bg-blue-50">
            <!-- コンテンツ部分 -->
            <main class="flex-grow">
                {{ $slot }}
            </main>
        </div>
        <!-- 下部ナビゲーション -->
        <x-footer />
    </body>
</html>




{{-- <!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <!-- Google Maps APIを条件付きで読み込む -->
        @if (Route::is('posts.create') || Route::is('posts.show'))
            <script
                src="https://maps.googleapis.com/maps/api/js?key={{ env('VITE_GOOGLE_MAPS_API_KEY') }}&libraries=places,marker&callback=initMap"
                async
                defer
            ></script>
        @endif
    </head>
    <body class="font-sans antialiased">
        <!-- 上部ナビゲーション -->
        <x-header />

        <!-- 全体のコンテンツ -->
        <div class="flex flex-col min-h-screen bg-gray-100">
            <main class="flex-grow">
                {{ $slot }}
            </main>
        </div>

        <!-- 下部ナビゲーション -->
        <x-footer />
    </body>
</html> --}}
