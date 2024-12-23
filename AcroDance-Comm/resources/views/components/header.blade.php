<div class="flex justify-between items-center bg-blue-900 p-4 text-white">
    <h1 class="text-xl font-bold">アクロバット・ダンスコミュニティ</h1>
    @auth
        <!-- ログアウトボタン -->
        <form method="POST" action="{{ route('logout') }}" class="flex items-center">
            @csrf
            <button type="submit" class="text-center hover:text-yellow-200 flex items-center">
                <svg class="w-6 h-6 mx-auto" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"></path>
                </svg>
                <span class="text-xs ml-2">ログアウト</span>
            </button>
        </form>
    @else
        <!-- ログインボタン -->
        <a href="{{ route('login') }}" class="text-center hover:text-yellow-200 flex items-center">
            <svg class="w-6 h-6 mx-auto" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"></path>
            </svg>
            <span class="text-xs ml-2">ログイン</span>
        </a>
    @endauth
</div>



{{-- <div class="flex justify-between items-center bg-blue-900 p-4 text-white">
    <h1 class="text-xl font-bold">アクロバット・ダンスコミュニティ</h1>
    @auth
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="text-white hover:text-yellow-200">ログアウト</button>
            <img src="/images/logout_icon.png" alt="ログアウトアイコン" class="w-6 h-6 mr-2">
        </form>
    @else
        <a href="{{ route('login') }}" class="text-white hover:text-yellow-200">ログイン</a>
         <img src="/images/login_icon.png" alt="ログインアイコン" class="w-6 h-6 mr-2">
    @endauth
</div> --}}



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