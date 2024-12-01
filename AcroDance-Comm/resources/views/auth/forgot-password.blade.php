<x-guest-layout>
    <div class="max-w-md mx-auto py-6">
        <h2 class="text-center text-2xl font-bold">パスワードの再設定</h2>
        <p class="text-center text-sm text-gray-500 mt-2">
            登録時のメールアドレスを入力してください。<br>
            パスワードリセット用リンクを送信します。
        </p>

        <!-- セッションステータス -->
        <x-auth-session-status class="mb-4" :status="session('status')" />

        <form method="POST" action="{{ route('password.email') }}" class="mt-6">
            @csrf

            <!-- メールアドレス -->
            <div class="mb-4">
                <label for="email" class="block text-sm font-medium text-gray-700">メールアドレス</label>
                <input id="email" class="block mt-1 w-full rounded border-gray-300" type="email" name="email" :value="old('email')" required autofocus>
                @error('email')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div class="mt-6 text-center">
                <button type="submit" class="bg-black text-white py-2 px-4 rounded hover:bg-gray-800">
                    パスワードリセットリンクを送信する
                </button>
            </div>
        </form>
    </div>
</x-guest-layout>
