{{-- <div class="flex justify-between items-center bg-gray-200 p-4 rounded-md">
    <h1 class="text-xl font-bold">アクロバット・ダンスコミュニティ</h1>
    <!-- ログイン状態を判定して表示を切り替える -->
    @auth
        <!-- ログイン済みの場合 -->
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="text-blue-500">ログアウト</button>
        </form>
    @else
        <!-- 未ログインの場合 -->
        <a href="{{ route('login') }}" class="text-blue-500">ログイン</a>
    @endauth
</div> --}}

<div class="flex justify-between items-center bg-blue-900 p-4 rounded-md text-white">
    <h1 class="text-xl font-bold">アクロバット・ダンスコミュニティ</h1>
    @auth
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="text-white">ログアウト</button>
        </form>
    @else
        <a href="{{ route('login') }}" class="text-white">ログイン</a>
    @endauth
</div>
