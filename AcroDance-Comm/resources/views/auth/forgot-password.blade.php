<x-app-layout>
    <div class="flex justify-center items-center min-h-screen bg-gray-100">
        <div class="w-full max-w-md bg-white p-6 rounded-lg shadow-md">
            <h2 class="text-center text-2xl font-bold mb-6">パスワードの再設定</h2>
            <p class="text-center text-sm text-gray-500 mb-6">
                登録時のメールアドレスを入力してください。<br>
                パスワードリセット用リンクを送信します。
            </p>

            <!-- セッションステータス -->
            <x-auth-session-status class="mb-4" :status="session('status')" />

            <form method="POST" action="{{ route('password.email') }}" class="space-y-6">
                @csrf

                <!-- メールアドレス -->
                <div>
                    <x-input-label for="email" :value="__('メールアドレス')" />
                    <x-text-input id="email" class="block mt-1 w-full border-gray-300 rounded-lg shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" type="email" name="email" :value="old('email')" required autofocus />
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                <!-- Submit Button -->
                <div class="flex items-center justify-center">
                    <x-primary-button class="w-full text-center">
                        パスワードリセットリンクを送信する
                    </x-primary-button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
