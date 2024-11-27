<x-app-layout>
    <div class="max-w-7xl mx-auto px-4 py-6">

        <!-- 通知メッセージの表示 -->
        @if (session('status'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-6">
                {{ session('status') }}
            </div>
        @endif

        <!-- 中段のメイン内容 -->
        <div class="my-6 pb-[100px]">
            <!-- メインキャッチフレーズ -->
            <div class="bg-gray-100 p-6 text-center rounded-md">
                <h2 class="text-lg font-semibold">ダンスとアクロバットの練習仲間<br>見つけませんか？</h2>
            </div>

            <!-- サイトの使い方 -->
            <div class="bg-gray-100 p-6 mt-4 rounded-md">
                <h3 class="text-md font-bold">本サイトの使い方</h3>
                <p class="mt-2 text-sm text-gray-700">
                    本サイトは社会人からダンスやアクロバットを始めたい方が、一緒に練習する仲間探しを手助けするサイトです。
                    <ul class="list-disc list-inside mt-2">
                        <li>その1 説明をしてみよう</li>
                        <li>その2 探してみよう</li>
                        <li>その3 遊んでみよう</li>
                    </ul>
                </p>
            </div>
        </div>

        <!-- 下部のナビゲーション -->
        <div class="fixed bottom-0 w-full bg-gray-200 p-4 flex justify-around h-[80px]">
            <a href="{{ route('home') }}" class="text-center">
                <svg class="w-6 h-6 mx-auto" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 12l9-9m0 0l9 9m-9-9v18"></path>
                </svg>
                <span class="text-xs">ホーム</span>
            </a>
            <a href="{{ route('search') }}" class="text-center">
                <svg class="w-6 h-6 mx-auto" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-4.35-4.35m0 0a8.5 8.5 0 111.42-1.42L21 21z"></path>
                </svg>
                <span class="text-xs">検索</span>
            </a>
            <a href="{{ route('profile.edit') }}" class="text-center">
                <svg class="w-6 h-6 mx-auto" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 14l9-9m-9 9l-9-9m9 9v10"></path>
                </svg>
                <span class="text-xs">マイページ</span>
            </a>
            <a href="{{ route('posts.create') }}" class="text-center">
                <svg class="w-6 h-6 mx-auto" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"></path>
                </svg>
                <span class="text-xs">投稿</span>
            </a>
        </div>
    </div>
</x-app-layout>
